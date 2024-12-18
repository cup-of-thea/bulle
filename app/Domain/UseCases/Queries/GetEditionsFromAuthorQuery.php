<?php

namespace App\Domain\UseCases\Queries;

use App\Domain\Repositories\IEditionsRepository;
use App\Models\Author;
use Illuminate\Support\Collection;

readonly final class GetEditionsFromAuthorQuery
{
    public function __construct(private IEditionsRepository $editionsRepository)
    {
    }

    public function get(Author $author): Collection
    {
        return $this->editionsRepository->getByAuthor($author);
    }
}