<?php

namespace App\Adapters\Repositories;

use App\Domain\Repositories\ICategoriesRepository;
use App\Domain\ValueObjects\CategoryItem;
use App\Models\Category;
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
                    Category::find($category->id)->authors()->limit(5)->get()
                );
            })
            ->filter(fn($category) => $category->postsCount > 0)
            ->collect();
    }
}
