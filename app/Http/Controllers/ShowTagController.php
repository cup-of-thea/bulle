<?php

namespace App\Http\Controllers;

use App\Domain\UseCases\Queries\GetTagFromSlugQuery;
use Illuminate\View\View;

readonly class ShowTagController
{
    public function __construct(private GetTagFromSlugQuery $getTagFromSlugQuery)
    {
    }

    public function __invoke(string $slug): View
    {
        return view('tags.show', ['tag' => $this->getTagFromSlugQuery->get($slug)]);
    }
}
