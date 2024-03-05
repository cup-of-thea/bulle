<?php

namespace App\Domain\UseCases\Queries;

use App\Domain\Repositories\IPostsRepository;
use App\Domain\ValueObjects\Post;

readonly class GetPostFromSlugQuery
{
    public function __construct(private IPostsRepository $postsRepository)
    {
    }

    public function get(string $slug): Post
    {
        return $this->postsRepository->getPostFromSlug($slug);
    }
}
