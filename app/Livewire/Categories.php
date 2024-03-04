<?php

namespace App\Livewire;

use App\Domain\UseCases\Queries\CategoriesQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Categories extends Component
{
    private CategoriesQuery $categoriesQuery;

    public function boot(CategoriesQuery $categoriesQuery): void
    {
        $this->categoriesQuery = $categoriesQuery;
    }

    #[Computed]
    public function categories(): Collection
    {
        return $this->categoriesQuery->get();
    }

    public function render(): View
    {
        return view('livewire.categories');
    }
}
