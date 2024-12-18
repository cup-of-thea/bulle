<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

readonly class ShowCategoryController
{
    public function __invoke(string $slug): View
    {
        return view('categories.show', ['category' => Category::where('slug', $slug)->first()]);
    }
}
