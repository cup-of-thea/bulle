<?php

namespace App\Domain\Repositories;

use App\Domain\ValueObjects\Author;
use Illuminate\Support\Collection;

interface IAuthorsRepository
{
    public function all(): Collection;

    public function getAuthorFromSlug(string $slug): ?Author;
}
