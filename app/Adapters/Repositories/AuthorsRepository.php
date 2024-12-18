<?php

namespace App\Adapters\Repositories;

use App\Domain\Repositories\IAuthorsRepository;
use App\Domain\ValueObjects\AuthorItem;
use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

readonly class AuthorsRepository implements IAuthorsRepository
{
    public function all(): Collection
    {
        return Author::query()
            ->limit(500)
            ->orderBy('name')
            ->get();
    }

    public function getCoAuthors(Author $author): Collection
    {
        return DB::table('authors as a')
            ->select('a.id', 'a.name', 'a.slug')
            ->join('post_author as pa', 'a.id', '=', 'pa.author_id')
            ->where(
                'pa.post_id',
                DB::table('post_author as pa')
                    ->select('pa.post_id')
                    ->where('pa.author_id', $author->id)
                    ->get()
                    ->pluck('post_id')
                    ->toArray()
            )
            ->where('a.id', '<>', $author->id)
            ->limit(500)
            ->get()
            ->map(fn($author) => $this->hydrateAuthor($author))
            ->collect();
    }

    private function hydrateAuthor($author): AuthorItem
    {
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
            config(
                "authors.$author->slug.image"
            ) ?? "https://ui-avatars.com/api/?name={$author->name}&color=7F9CF5&background=EBF4FF&size=256&bold=true&font-size=0.40",
            $postsCount,
            $lastPost->title,
            $lastPost->slug,
            new Carbon($lastPost->date),
        );
    }
}
