<?php

namespace App\Adapters\Repositories;

use App\Domain\Repositories\ITagsRepository;
use App\Domain\ValueObjects\Tag;
use App\Domain\ValueObjects\TagId;
use App\Domain\ValueObjects\TagItem;
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
                    DB::table('post_author as pa')
                        ->select('a.name', 'a.slug')
                        ->join('authors as a', 'pa.author_id', '=', 'a.id')
                        ->join('posts as p', 'pa.post_id', '=', 'p.id')
                        ->join('post_tag as pt', 'p.id', '=', 'pt.post_id')
                        ->where('pt.tag_id', $tag->id)
                        ->orderBy('p.date', 'desc')
                        ->limit(5)
                        ->get()
                        ->toArray(),
                );
            })
            ->collect();
    }

    public function getTagFromSlug(string $slug): ?Tag
    {
        $data = DB::table('tags as t')
            ->select('t.id',  't.title', 't.slug')
            ->where('t.slug', $slug)
            ->first();

        return $data ? Tag::from(TagId::from($data->id), $data->title, $data->slug) : null;
    }
}
