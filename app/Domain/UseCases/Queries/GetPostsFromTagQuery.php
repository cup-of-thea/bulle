<?php

namespace App\Domain\UseCases\Queries;

use App\Domain\Repositories\IPostsRepository;
use App\Domain\ValueObjects\Tag;
use Illuminate\Support\Collection;

readonly class GetPostsFromTagQuery
{
    public function __construct(private IPostsRepository $postsRepository)
    {
    }

    public function get(Tag $tag): Collection
    {
        return $this->postsRepository->getPostsFromTag($tag);
    }
}
