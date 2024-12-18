<?php

namespace App\Domain\Repositories;

use Illuminate\Support\Collection;

interface ICategoriesRepository
{
    public function all(): Collection;
}
