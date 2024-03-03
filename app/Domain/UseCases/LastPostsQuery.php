<?php

namespace App\Domain\UseCases;

use App\Domain\ValueObjects\PostItem;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Thea\MarkdownBlog\Domain\ValueObjects\Category;

class LastPostsQuery
{
    public function get(): Collection
    {
        return DB::table('posts as p')
            ->select('p.id', 'p.title', 'p.slug', 'p.date', 'p.description', 'p.content', 'c.title as category_title', 'c.slug as category_slug',)
            ->leftJoin('categories as c', 'p.category_id', '=', 'c.id')
            ->orderBy('date', 'desc')
            ->get()
            ->map(fn($post) => PostItem::from(
                $post->title,
                $post->slug,
                $post->description,
                $post->content,
                new Carbon($post->date),
                $post->category_slug ? Category::from($post->category_title, $post->category_slug) : null,
                DB::table('post_author as pa')
                    ->select('a.name', 'a.slug')
                    ->join('authors as a', 'pa.author_id', '=', 'a.id')
                    ->where('pa.post_id', $post->id)
                    ->get()
                    ->toArray(),
                DB::table('post_tag as pt')
                    ->select('t.title', 't.slug')
                    ->join('tags as t', 'pt.tag_id', '=', 't.id')
                    ->where('pt.post_id', $post->id)
                    ->get()
                    ->toArray(),
            ))->collect();
    }
}
