<?php

namespace App\Http\Controllers;

use App\Domain\UseCases\Queries\GetPostFromSlugQuery;
use Illuminate\View\View;

readonly class ShowPostController
{
    public function __construct(private GetPostFromSlugQuery $getPostFromSlugQuery)
    {
    }

    public function __invoke(string $slug): View
    {
        return view('posts.show', ['post' => $this->getPostFromSlugQuery->get($slug)]);
    }
}
