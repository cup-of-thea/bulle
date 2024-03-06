<?php

namespace App\Domain\UseCases\Queries;

use App\Domain\Repositories\IAuthorsRepository;
use App\Domain\ValueObjects\Author;
use Illuminate\Support\Collection;

readonly final class GetCoAuthorsFromAuthorQuery
{
    public function __construct(private IAuthorsRepository $authorsRepository)
    {
    }

    public function get(Author $author): Collection
    {
        return $this->authorsRepository->getCoAuthors($author);
    }
}