<?php

namespace App\Adapters\Repositories;

use App\Domain\Repositories\ICategoriesRepository;
use App\Domain\ValueObjects\Category;
use App\Domain\ValueObjects\CategoryId;
use App\Domain\ValueObjects\CategoryItem;
use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CategoriesRepository implements ICategoriesRepository
{
    public function all(): Collection
    {
        return DB::table('categories as c')
            ->select('c.id', 'c.title', 'c.slug')
            ->limit(500)
            ->get()
            ->map(function ($category) {
                $lastPost = DB::table('posts')
                    ->select('title', 'slug', 'date')
                    ->where('category_id', $category->id)
                    ->orderBy('date', 'desc')
                    ->first();
                $postsCount = DB::table('posts')
                    ->select('id')
                    ->where('category_id', $category->id)
                    ->count();
                return CategoryItem::from(
                    $category->title,
                    $category->slug,
                    $postsCount,
                    $lastPost->title ?? '',
                    $lastPost->slug ?? '',
                    new Carbon($lastPost->date ?? ''),
                    DB::table('post_author as pa')
                        ->select('a.name', 'a.slug')
                        ->join('authors as a', 'pa.author_id', '=', 'a.id')
                        ->join('posts as p', 'pa.post_id', '=', 'p.id')
                        ->where('p.category_id', $category->id)
                        ->orderBy('p.date', 'desc')
                        ->limit(5)
                        ->get()
                        ->toArray(),
                );
            })
            ->filter(fn($category) => $category->postsCount > 0)
            ->collect();
    }

    public function getBySlug(string $slug): ?Category
    {
        $data = DB::table('categories as c')
            ->select('c.id', 'c.title', 'c.slug')
            ->where('c.slug', $slug)
            ->first();

        return $data ? Category::from(CategoryId::from($data->id), $data->title, $data->slug) : null;
    }

    public function getByAuthor(Author $author): Collection
    {
        return DB::table('categories as c')
            ->select('c.id', 'c.title', 'c.slug')
            ->join('posts as p', 'c.id', '=', 'p.category_id')
            ->join('post_author as pa', 'p.id', '=', 'pa.post_id')
            ->join('authors as a', 'pa.author_id', '=', 'a.id')
            ->where('a.id', $author->id)
            ->limit(500)
            ->get()
            ->map(fn($category) => Category::from(CategoryId::from($category->id), $category->title, $category->slug));
    }
}
