<?php

namespace App\Domain\UseCases\Queries;

use App\Domain\Repositories\ICategoriesRepository;
use App\Models\Author;
use Illuminate\Support\Collection;

readonly final class GetCategoriesFromAuthorQuery
{
    public function __construct(private ICategoriesRepository $categoriesRepository)
    {
    }

    public function get(Author $author): Collection
    {
        return $this->categoriesRepository->getByAuthor($author);
    }
}