<?php

namespace App\Domain\Repositories;

use App\Domain\ValueObjects\Author;
use App\Domain\ValueObjects\Category;
use Illuminate\Support\Collection;

interface ICategoriesRepository
{
    public function all(): Collection;

    public function getBySlug(string $slug): ?Category;

    public function getByAuthor(Author $author): Collection;
}
