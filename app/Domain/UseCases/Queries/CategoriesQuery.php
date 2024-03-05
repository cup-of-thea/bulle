<?php

namespace App\Domain\UseCases\Queries;

use App\Domain\Repositories\ICategoriesRepository;
use Illuminate\Support\Collection;

readonly class CategoriesQuery
{
    public function __construct(private ICategoriesRepository $categoriesRepository)
    {
    }

    public function all(): Collection
    {
        return $this->categoriesRepository->all();
    }
}
