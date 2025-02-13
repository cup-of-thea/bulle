<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class GetLastPostsComponent extends Component
{
    #[Computed]
    public function posts(): Collection
    {
        return Post::orderBy('date', 'desc')->limit(500)->get();
    }
}
