<?php

namespace App\Domain\Repositories;

use App\Domain\ValueObjects\Author;
use App\Domain\ValueObjects\Tag;
use Illuminate\Support\Collection;

interface ITagsRepository
{

    public function all(): Collection;

    public function getBySlug(string $slug): ?Tag;

    public function getByAuthor(Author $author): Collection;
}
