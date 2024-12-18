<?php

namespace App\Domain\UseCases\Queries;

use App\Models\Author;

readonly class GetAuthorFromSlugQuery
{
    public function get(string $slug): ?Author
    {
        return Author::where('slug', $slug)->first();
    }
}