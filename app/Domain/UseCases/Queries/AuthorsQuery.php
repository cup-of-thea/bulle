<?php

namespace App\Domain\UseCases\Queries;

use App\Domain\ValueObjects\AuthorItem;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AuthorsQuery
{
    public function get(): Collection
    {
        return DB::table('authors as t')
            ->select('t.id', 't.name', 't.slug')
            ->get()
            ->map(function ($author) {
                $lastPost = DB::table('posts as p')
                    ->select('p.title', 'p.slug', 'p.date')
                    ->join('post_author as pa', 'p.id', '=', 'pa.post_id')
                    ->where('pa.author_id', $author->id)
                    ->orderBy('date', 'desc')
                    ->first();
                $postsCount = DB::table('posts as p')
                    ->select('p.id')
                    ->join('post_author as pa', 'p.id', '=', 'pa.post_id')
                    ->where('pa.author_id', $author->id)
                    ->count();
                return AuthorItem::from(
                    $author->name,
                    $author->slug,
                    $postsCount,
                    $lastPost->title,
                    $lastPost->slug,
                    new Carbon($lastPost->date),
                );
            })
            ->collect()
            ;
    }
}
