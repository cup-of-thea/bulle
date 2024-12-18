<?php

namespace App\Livewire;

use App\Models\Author;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ListAuthorsComponent extends Component
{
    #[Computed]
    public function authors(): Collection
    {
        return Author::limit(500)->orderBy('name')->get();
    }
}
