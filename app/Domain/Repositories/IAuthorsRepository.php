<?php

namespace App\Domain\Repositories;

use Illuminate\Support\Collection;

interface IAuthorsRepository
{
    public function all(): Collection;
}
