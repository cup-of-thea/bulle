<?php

namespace App\Domain\UseCases\Queries;

use App\Domain\Repositories\IAuthorsRepository;
use App\Domain\ValueObjects\Author;

readonly class GetAuthorFromSlugQuery
{
    public function __construct(private IAuthorsRepository $authorsRepository)
    {
    }

    public function get(string $slug): ?Author
    {
        return $this->authorsRepository->getAuthorFromSlug($slug);
    }
}