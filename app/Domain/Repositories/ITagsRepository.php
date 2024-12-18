<?php

namespace App\Domain\Repositories;

use App\Models\Author;
use Illuminate\Support\Collection;

interface ITagsRepository
{

    public function all(): Collection;

    public function getByAuthor(Author $author): Collection;
}
