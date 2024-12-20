<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use Illuminate\Http\RedirectResponse;

readonly class LastEditionController
{
    public function __invoke(): RedirectResponse
    {
        return redirect()->route('editions.show', ['slug' => Edition::orderBy('id', 'desc')->first()->slug]);
    }
}
