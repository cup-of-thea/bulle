<?php

namespace App\Domain\UseCases;

use App\Domain\ValueObjects\CategoryItem;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CategoriesQuery
{
    public function get(): Collection
    {
        return DB::table('categories as c')
            ->select('c.id', 'c.title', 'c.slug')
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
                    $lastPost->title,
                    $lastPost->slug,
                    new Carbon($lastPost->date),
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
            ->collect()
            ;
    }
}
