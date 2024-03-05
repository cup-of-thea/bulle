<?php

namespace App\Domain\Repositories;

use App\Domain\ValueObjects\Tag;
use Illuminate\Support\Collection;

interface ITagsRepository
{

    public function all(): Collection;

    public function getTagFromSlug(string $slug): ?Tag;
}
