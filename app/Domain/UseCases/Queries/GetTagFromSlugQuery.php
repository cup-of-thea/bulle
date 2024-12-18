<?php

namespace App\Domain\UseCases\Queries;

use App\Models\Tag;

readonly class GetTagFromSlugQuery
{
    public function get(string $slug): ?Tag
    {
        return Tag::where('slug', $slug)->first();
    }
}
