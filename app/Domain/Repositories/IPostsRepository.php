<?php

namespace App\Domain\Repositories;

use App\Domain\ValueObjects\Author;
use App\Domain\ValueObjects\Category;
use App\Domain\ValueObjects\Edition;
use App\Domain\ValueObjects\Post;
use App\Domain\ValueObjects\Tag;
use Illuminate\Support\Collection;

interface IPostsRepository
{
    public function getLastPosts(): Collection;

    public function getPostsFromCategory(Category $category): Collection;

    public function getPostsFromTag(Tag $tag): Collection;

    public function getPostFromSlug(string $slug): Post;

    public function getPostsFromEdition(Edition $edition): Collection;

    public function getPostsByAuthor(Author $author): Collection;
}
