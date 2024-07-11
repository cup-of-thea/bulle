<?php

namespace App\Http\Controllers;

use App\Domain\UseCases\Queries\GetLastEditionSlugQuery;
use Illuminate\Http\RedirectResponse;

readonly class LastEditionController
{
    public function __construct(
        private GetLastEditionSlugQuery $lastEditionSlugQuery
    ) {
    }

    public function __invoke(): RedirectResponse
    {
        return redirect()->route('editions.show', ['slug' => $this->lastEditionSlugQuery->get()]);
    }
}