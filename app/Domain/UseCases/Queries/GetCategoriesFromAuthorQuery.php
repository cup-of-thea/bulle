<?php

namespace App\Domain\UseCases\Queries;

use App\Models\Author;
use Illuminate\Support\Collection;

readonly final class GetCategoriesFromAuthorQuery
{
    public function get(Author $author): Collection
    {
        return $author->categories()->limit(500)->orderBy('title')->get();
    }
}