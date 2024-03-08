<?php

namespace App\Adapters\Repositories;

use App\Domain\Repositories\IAuthorsRepository;
use App\Domain\ValueObjects\Author;
use App\Domain\ValueObjects\AuthorId;
use App\Domain\ValueObjects\AuthorItem;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

readonly class AuthorsRepository implements IAuthorsRepository
{
    public function all(): Collection
    {
        return DB::table('authors as t')
            ->select('t.id', 't.name', 't.slug')
            ->limit(500)
            ->get()
            ->map(fn($author) => $this->hydrateAuthor($author))
            ->collect();
    }

    public function getAuthorFromSlug(string $slug): ?Author
    {
        $author = DB::table('authors as t')
            ->select('t.id', 't.name', 't.slug')
            ->where('t.slug', $slug)
            ->first();

        return Author::from(
            AuthorId::from($author->id),
            $author->name,
            $author->slug,
            config("authors.$author->slug.title") ?? '',
            config("authors.$author->slug.bio") ?? '',
            config(
                "authors.$author->slug.image"
            ) ?? "https://ui-avatars.com/api/?name={$author->name}&color=7F9CF5&background=EBF4FF&size=256&bold=true&font-size=0.40",
            collect(config("authors.$author->slug.links")) ?? collect(),
        );
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
                    ->where('pa.author_id', $author->authorId->value())
                    ->get()
                    ->pluck('post_id')
                    ->toArray()
            )
            ->where('a.id', '<>', $author->authorId->value())
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
