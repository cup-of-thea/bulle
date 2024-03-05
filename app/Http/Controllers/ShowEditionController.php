<?php

namespace App\Http\Controllers;

use App\Domain\UseCases\Queries\GetEditionFromSlugQuery;
use Illuminate\View\View;

readonly class ShowEditionController
{
    public function __construct(
        private GetEditionFromSlugQuery $getEditionFromSlugQuery
    ) {
    }

    public function __invoke(string $slug): View
    {
        return view('editions.show', ['edition' => $this->getEditionFromSlugQuery->get($slug)]);
    }
}