<?php

namespace App\Http\Controllers;

use App\Domain\UseCases\Queries\GetCategoryFromSlugQuery;
use Illuminate\View\View;

readonly class ShowCategoryController
{
    public function __construct(
        private GetCategoryFromSlugQuery $getCategoryFromSlugQuery
    )
    {
    }

    public function __invoke(string $slug): View
    {
        return view('categories.show', ['category' => $this->getCategoryFromSlugQuery->get($slug)]);
    }
}
