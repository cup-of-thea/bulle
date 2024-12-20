<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ListCategoriesComponent extends Component
{
    #[Computed]
    public function categories(): Collection
    {
        return Category::limit(500)->orderBy('title')->get();
    }
}
