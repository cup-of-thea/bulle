<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\View\View;

readonly class ShowAuthorController
{
    public function __invoke(string $slug): View
    {
        return view('authors.show', ['author' => Author::where('slug', $slug)->first()]);
    }
}