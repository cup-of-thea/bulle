<?php

namespace App\Livewire;

use App\Models\Tag;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class ShowTagComponent extends Component
{
    #[Locked]
    public Tag $tag;

    #[Computed]
    public function posts(): Collection
    {
        return $this->tag->posts()->limit(500)->get();
    }
}
