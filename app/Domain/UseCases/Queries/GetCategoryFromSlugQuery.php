<?php

namespace App\Domain\UseCases\Queries;

use App\Domain\Repositories\ICategoriesRepository;
use App\Domain\ValueObjects\Category;

readonly class GetCategoryFromSlugQuery
{
    public function __construct(private ICategoriesRepository $categoriesRepository)
    {
    }

    public function get(string $slug): ?Category
    {
        return $this->categoriesRepository->getBySlug($slug);
    }
}
