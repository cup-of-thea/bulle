<?php

namespace App\Livewire;

use App\Models\Author;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class ShowAuthorComponent extends Component
{
    #[Locked]
    public Author $author;

    #[Computed]
    public function posts(): Collection
    {
        return $this->author->posts()->limit(500)->orderBy('date', 'desc')->get();
    }

    #[Computed]
    public function categories(): Collection
    {
        return $this->author->categories()->limit(500)->orderBy('title')->get();
    }
}