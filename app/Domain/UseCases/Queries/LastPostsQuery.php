<?php

namespace App\Domain\UseCases\Queries;

use App\Domain\Repositories\IPostsRepository;
use Illuminate\Support\Collection;

readonly class LastPostsQuery
{
    public function __construct(private IPostsRepository $postsRepository)
    {
    }

    public function get(): Collection
    {
        return $this->postsRepository->getLastPosts();
    }
}
