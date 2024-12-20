<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasLastPost
{
    public function lastPost(): Attribute
    {
        return Attribute::make(
            fn () => $this->posts->sortByDesc('date')->first()
        );
    }
}
