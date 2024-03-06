<?php

namespace App\Http\Controllers;

use App\Domain\UseCases\Queries\GetAuthorFromSlugQuery;
use Illuminate\View\View;

readonly class ShowAuthorController
{
    public function __construct(
        private GetAuthorFromSlugQuery $getAuthorFromSlugQuery
    ) {
    }

    public function __invoke(string $slug): View
    {
        return view('authors.show', ['author' => $this->getAuthorFromSlugQuery->get($slug)]);
    }
}