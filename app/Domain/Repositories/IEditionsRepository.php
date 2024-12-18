<?php

namespace App\Domain\Repositories;

use App\Domain\ValueObjects\Edition;
use App\Models\Author;
use Illuminate\Support\Collection;

interface IEditionsRepository
{
    public function all(): Collection;

    public function getBySlug(string $slug): ?Edition;

    public function getByAuthor(Author $author): Collection;

    public function getLastEditionSlug(): ?string;
}