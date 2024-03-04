<?php

namespace App\Domain\UseCases\Queries;

use App\Domain\ValueObjects\Category;
use App\Domain\ValueObjects\CategoryId;
use Illuminate\Support\Facades\DB;

class GetCategoryFromSlugQuery
{
    public function get(string $slug): ?object
    {
        $data = DB::table('categories as c')
            ->select('c.id',  'c.title', 'c.slug')
            ->where('c.slug', $slug)
            ->first();

        return $data ? Category::from(CategoryId::from($data->id), $data->title, $data->slug) : null;
    }
}
