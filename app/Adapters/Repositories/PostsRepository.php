<?php

namespace App\Adapters\Repositories;

use App\Domain\Repositories\IPostsRepository;
use App\Domain\ValueObjects\Author;
use App\Domain\ValueObjects\Category;
use App\Domain\ValueObjects\CategoryId;
use App\Domain\ValueObjects\Edition;
use App\Domain\ValueObjects\EditionId;
use App\Domain\ValueObjects\Post;
use App\Domain\ValueObjects\Tag;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PostsRepository implements IPostsRepository
{
    private const COLUMNS = [
        'p.id',
        'p.title',
        'p.slug',
        'p.date',
        'p.description',
        'p.content',
        'p.canonical',
        'c.id as categoryId',
        'c.title as categoryTitle',
        'c.slug as categorySlug',
        'e.id as editionId',
        'e.title as editionTitle',
        'e.slug as editionSlug',
    ];

    public function getLastPosts(): Collection
    {
        return DB::table('posts as p')
            ->select(...self::COLUMNS)
            ->leftJoin('categories as c', 'p.category_id', '=', 'c.id')
            ->leftJoin('editions as e', 'p.edition_id', '=', 'e.id')
            ->orderBy('date', 'desc')
            ->limit(500)
            ->get()
            ->map(fn($post) => $this->hydratePostItem($post))->collect();
    }

    public function getPostsFromCategory(Category $category): Collection
    {
        return DB::table('posts as p')
            ->select(...self::COLUMNS)
            ->leftJoin('categories as c', 'p.category_id', '=', 'c.id')
            ->leftJoin('editions as e', 'p.edition_id', '=', 'e.id')
            ->where('c.id', $category->categoryId->value())
            ->orderBy('p.title')
            ->limit(500)
            ->get()
            ->map(fn($post) => $this->hydratePostItem($post))->collect();
    }

    public function getPostsFromEdition(Edition $edition): Collection
    {
        return DB::table('posts as p')
            ->select(...self::COLUMNS)
            ->leftJoin('categories as c', 'p.category_id', '=', 'c.id')
            ->leftJoin('editions as e', 'p.edition_id', '=', 'e.id')
            ->where('e.id', $edition->editionId->value())
            ->orderBy('date', 'desc')
            ->limit(500)
            ->get()
            ->map(fn($post) => $this->hydratePostItem($post))->collect();
    }

    public function getPostsFromTag(Tag $tag): Collection
    {
        return DB::table('posts as p')
            ->select(...self::COLUMNS)
            ->leftJoin('categories as c', 'p.category_id', '=', 'c.id')
            ->leftJoin('editions as e', 'p.edition_id', '=', 'e.id')
            ->join('post_tag as pt', 'p.id', '=', 'pt.post_id')
            ->join('tags as t', 'pt.tag_id', '=', 't.id')
            ->where('t.id', $tag->tagId->value())
            ->orderBy('date', 'desc')
            ->limit(500)
            ->get()
            ->map(fn($post) => $this->hydratePostItem($post))->collect();
    }

    public function getPostFromSlug(string $slug): Post
    {
        $post = DB::table('posts as p')
            ->select(...self::COLUMNS)
            ->leftJoin('categories as c', 'p.category_id', '=', 'c.id')
            ->leftJoin('editions as e', 'p.edition_id', '=', 'e.id')
            ->where('p.slug', $slug)
            ->first();

        return $this->hydratePostItem($post);
    }

    public function getPostsByAuthor(Author $author): Collection
    {
        return DB::table('posts as p')
            ->select(...self::COLUMNS)
            ->leftJoin('categories as c', 'p.category_id', '=', 'c.id')
            ->leftJoin('editions as e', 'p.edition_id', '=', 'e.id')
            ->join('post_author as pa', 'p.id', '=', 'pa.post_id')
            ->join('authors as a', 'pa.author_id', '=', 'a.id')
            ->where('a.id', $author->authorId->value())
            ->orderBy('date', 'desc')
            ->limit(500)
            ->get()
            ->map(fn($post) => $this->hydratePostItem($post))->collect();
    }

    protected function hydratePostItem($post): Post
    {
        return Post::from(
            $post->title,
            $post->slug,
            $post->description,
            $post->content,
            new Carbon($post->date),
            $post->categorySlug
                ? Category::from(CategoryId::from($post->categoryId), $post->categoryTitle, $post->categorySlug)
                : null,
            $post->editionSlug
                ? Edition::from(EditionId::from($post->editionId), $post->editionTitle, $post->editionSlug)
                : null,
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
            $post->canonical,
        );
    }
}
