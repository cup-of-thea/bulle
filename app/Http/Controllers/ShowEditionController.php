<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use Illuminate\View\View;

readonly class ShowEditionController
{
    public function __invoke(string $slug): View
    {
        return view('editions.show', ['edition' => Edition::where('slug', $slug)->first()]);
    }
}