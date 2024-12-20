<?php

namespace App\Livewire;

use App\Models\Author;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ListAuthorsComponent extends Component
{
    #[Computed]
    public function permanentAuthors(): Collection
    {
        return Author::permanent()->limit(500)->orderBy('name')->get();
    }

    #[Computed]
    public function guestAuthors(): Collection
    {
        return Author::guest()->limit(500)->orderBy('name')->get();
    }
}
