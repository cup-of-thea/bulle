<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

readonly class ShowPostController
{
    public function __invoke(string $slug): View
    {
        return view('posts.show', ['post' => Post::where('posts.slug', $slug)->firstOrFail()]);
    }
}
