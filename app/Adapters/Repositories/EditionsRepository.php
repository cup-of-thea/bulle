<?php

namespace App\Adapters\Repositories;

use App\Domain\Repositories\IEditionsRepository;
use App\Domain\ValueObjects\Author;
use App\Domain\ValueObjects\Edition;
use App\Domain\ValueObjects\EditionId;
use App\Domain\ValueObjects\EditionItem;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class EditionsRepository implements IEditionsRepository
{
    public function all(): Collection
    {
        return DB::table('editions as c')
            ->select('c.id', 'c.title', 'c.slug')
            ->limit(500)
            ->orderBy('c.id', 'desc')
            ->get()
            ->map(function ($edition) {
                $lastPost = DB::table('posts')
                    ->select('title', 'slug', 'date')
                    ->where('edition_id', $edition->id)
                    ->orderBy('date', 'desc')
                    ->first();
                $postsCount = DB::table('posts')
                    ->select('id')
                    ->where('edition_id', $edition->id)
                    ->count();
                return EditionItem::from(
                    $edition->title,
                    $edition->slug,
                    $postsCount,
                    $lastPost->title,
                    $lastPost->slug,
                    new Carbon($lastPost->date),
                    DB::table('post_author as pa')
                        ->select('a.name', 'a.slug')
                        ->join('authors as a', 'pa.author_id', '=', 'a.id')
                        ->join('posts as p', 'pa.post_id', '=', 'p.id')
                        ->where('p.edition_id', $edition->id)
                        ->orderBy('p.date', 'desc')
                        ->limit(5)
                        ->get()
                        ->toArray(),
                );
            })
            ->collect();
    }

    public function getBySlug(string $slug): ?Edition
    {
        $data = DB::table('editions as c')
            ->select('c.id', 'c.title', 'c.slug')
            ->where('c.slug', $slug)
            ->first();

        return $data ? Edition::from(EditionId::from($data->id), $data->title, $data->slug) : null;
    }

    public function getByAuthor(Author $author): Collection
    {
        return DB::table('editions as e')
            ->select('e.id', 'e.title', 'e.slug')
            ->join('posts as p', 'e.id', '=', 'p.edition_id')
            ->join('post_author as pa', 'p.id', '=', 'pa.post_id')
            ->join('authors as a', 'pa.author_id', '=', 'a.id')
            ->where('a.id', $author->authorId->value())
            ->limit(500)
            ->get()
            ->map(fn($edition) => Edition::from(EditionId::from($edition->id), $edition->title, $edition->slug));
    }

    public function getLastEditionSlug(): ?string
    {
        return DB::table('editions')
            ->select('slug')
            ->orderBy('id', 'desc')
            ->first()?->slug;
    }
}