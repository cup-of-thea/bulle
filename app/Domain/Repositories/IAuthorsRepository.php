<?php

namespace App\Domain\Repositories;

use App\Models\Author;
use Illuminate\Support\Collection;

interface IAuthorsRepository
{
    public function all(): Collection;

    public function getCoAuthors(Author $author): Collection;
}
