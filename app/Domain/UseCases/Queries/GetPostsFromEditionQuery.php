<?php

namespace App\Domain\UseCases\Queries;

use App\Domain\Repositories\IPostsRepository;
use App\Domain\ValueObjects\Edition;
use Illuminate\Support\Collection;

readonly class GetPostsFromEditionQuery
{
    public function __construct(private IPostsRepository $postsRepository)
    {
    }

    public function get(Edition $edition): Collection
    {
        return $this->postsRepository->getPostsFromEdition($edition);
    }
}