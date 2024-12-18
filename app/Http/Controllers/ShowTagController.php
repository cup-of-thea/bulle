<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\View\View;

readonly class ShowTagController
{
    public function __invoke(string $slug): View
    {
        return view('tags.show', ['tag' => Tag::where('slug', $slug)->first()]);
    }
}
