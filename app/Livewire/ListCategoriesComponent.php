<?php

namespace App\Livewire;

use App\Domain\UseCases\Queries\ListCategoriesQuery;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ListCategoriesComponent extends Component
{
    private ListCategoriesQuery $categoriesQuery;

    public function boot(ListCategoriesQuery $categoriesQuery): void
    {
        $this->categoriesQuery = $categoriesQuery;
    }

    #[Computed]
    public function categories(): Collection
    {
        return $this->categoriesQuery->all();
    }
}
