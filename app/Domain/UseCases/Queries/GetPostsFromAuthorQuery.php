<?php

namespace App\Domain\UseCases\Queries;

use App\Domain\Repositories\IPostsRepository;
use App\Domain\ValueObjects\Author;
use Illuminate\Support\Collection;

readonly class GetPostsFromAuthorQuery
{
    public function __construct(private IPostsRepository $postsRepository)
    {
    }

    public function get(Author $author): Collection
    {
        return $this->postsRepository->getPostsByAuthor($author);
    }
}