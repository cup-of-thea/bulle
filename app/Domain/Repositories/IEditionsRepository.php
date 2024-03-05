<?php

namespace App\Domain\Repositories;

use App\Domain\ValueObjects\Edition;
use Illuminate\Support\Collection;

interface IEditionsRepository
{
    public function all(): Collection;

    public function getEditionFromSlug(string $slug): ?Edition;
}