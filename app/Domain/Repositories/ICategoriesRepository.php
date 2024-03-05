<?php

namespace App\Domain\Repositories;

use App\Domain\ValueObjects\Category;
use Illuminate\Support\Collection;

interface ICategoriesRepository
{
    public function all(): Collection;

    public function getCategoryFromSlug(string $slug): ?Category;
}
