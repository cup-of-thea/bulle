<?php

namespace App\Livewire;

use App\Models\Tag;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ListTagsComponent extends Component
{
    #[Computed]
    public function tags(): Collection
    {
        return Tag::limit(500)->orderBy('title')->get();
    }
}
