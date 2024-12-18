<?php

namespace App\Adapters\Repositories;

use App\Domain\Repositories\ITagsRepository;
use App\Domain\ValueObjects\Tag;
use App\Domain\ValueObjects\TagId;
use App\Domain\ValueObjects\TagItem;
use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TagsRepository implements ITagsRepository
{
    public function all(): Collection
    {
        return DB::table('tags as t')
            ->select('t.id', 't.title', 't.slug')
            ->limit(500)
            ->get()
            ->map(function ($tag) {
                $lastPost = DB::table('posts as p')
                    ->select('p.title', 'p.slug', 'p.date')
                    ->join('post_tag as pt', 'p.id', '=', 'pt.post_id')
                    ->where('pt.tag_id', $tag->id)
                    ->orderBy('date', 'desc')
                    ->first();
                $postsCount = DB::table('posts as p')
                    ->select('p.id')
                    ->join('post_tag as pt', 'p.id', '=', 'pt.post_id')
                    ->where('pt.tag_id', $tag->id)
                    ->count();
                return TagItem::from(
                    $tag->title,
                    $tag->slug,
                    $postsCount,
                    $lastPost->title,
                    $lastPost->slug,
                    new Carbon($lastPost->date),
                    \App\Models\Tag::find($tag->id)
                        ->authors()
                        ->limit(5)
                        ->get()
                );
            })
            ->collect();
    }

    public function getByAuthor(Author $author): Collection
    {
        return DB::table('tags as t')
            ->select('t.id', 't.title', 't.slug')
            ->join('post_tag as pt', 't.id', '=', 'pt.tag_id')
            ->join('posts as p', 'pt.post_id', '=', 'p.id')
            ->join('post_author as pa', 'p.id', '=', 'pa.post_id')
            ->where('pa.author_id', $author->id)
            ->limit(500)
            ->get()
            ->map(fn($tag) => Tag::from(TagId::from($tag->id), $tag->title, $tag->slug));
    }
}
