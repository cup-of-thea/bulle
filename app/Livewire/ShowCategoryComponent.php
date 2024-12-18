<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class ShowCategoryComponent extends Component
{
    #[Locked]
    public Category $category;

    #[Computed]
    public function posts(): Collection
    {
        return $this->category->posts()->orderBy('date', 'desc')->limit(500)->get();
    }
}
