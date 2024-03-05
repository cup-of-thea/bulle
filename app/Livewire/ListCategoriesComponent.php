<?php

namespace App\Livewire;

use App\Domain\UseCases\Queries\CategoriesQuery;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ListCategoriesComponent extends Component
{
    private CategoriesQuery $categoriesQuery;

    public function boot(CategoriesQuery $categoriesQuery): void
    {
        $this->categoriesQuery = $categoriesQuery;
    }

    #[Computed]
    public function categories(): Collection
    {
        return $this->categoriesQuery->all();
    }
}
