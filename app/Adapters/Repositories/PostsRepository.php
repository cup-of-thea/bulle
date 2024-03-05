<?php

namespace App\Adapters\Repositories;

use App\Domain\Repositories\IPostsRepository;
use App\Domain\ValueObjects\Category;
use App\Domain\ValueObjects\CategoryId;
use App\Domain\ValueObjects\Post;
use App\Domain\ValueObjects\Tag;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PostsRepository implements IPostsRepository
{
    public function getLastPosts(): Collection
    {
        return DB::table('posts as p')
            ->select(
                'p.id',
                'p.title',
                'p.slug',
                'p.date',
                'p.description',
                'p.content',
                'c.id as categoryId',
                'c.title as categoryTitle',
                'c.slug as categorySlug',
            )
            ->leftJoin('categories as c', 'p.category_id', '=', 'c.id')
            ->orderBy('date', 'desc')
            ->limit(500)
            ->get()
            ->map(fn($post) => $this->hydratePostItem($post))->collect();
    }

    public function getPostsFromCategory(Category $category): Collection
    {
        return DB::table('posts as p')
            ->select(
                'p.id',
                'p.title',
                'p.slug',
                'p.date',
                'p.description',
                'p.content',
                'c.id as categoryId',
                'c.title as categoryTitle',
                'c.slug as categorySlug',
            )
            ->leftJoin('categories as c', 'p.category_id', '=', 'c.id')
            ->where('c.id', $category->categoryId->value())
            ->orderBy('date', 'desc')
            ->limit(500)
            ->get()
            ->map(fn($post) => $this->hydratePostItem($post))->collect();
    }

    public function getPostsFromTag(Tag $tag): Collection
    {
        return DB::table('posts as p')
            ->select(
                'p.id',
                'p.title',
                'p.slug',
                'p.date',
                'p.description',
                'p.content',
                'c.id as categoryId',
                'c.title as categoryTitle',
                'c.slug as categorySlug',
            )
            ->leftJoin('categories as c', 'p.category_id', '=', 'c.id')
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
            ->select(
                'p.id',
                'p.title',
                'p.slug',
                'p.date',
                'p.description',
                'p.content',
                'c.id as categoryId',
                'c.title as categoryTitle',
                'c.slug as categorySlug',
            )
            ->leftJoin('categories as c', 'p.category_id', '=', 'c.id')
            ->where('p.slug', $slug)
            ->first();

        return $this->hydratePostItem($post);
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
        );
    }
}
