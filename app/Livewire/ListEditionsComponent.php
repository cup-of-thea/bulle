<?php

namespace App\Livewire;

use App\Domain\UseCases\Queries\ListEditionsQuery;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ListEditionsComponent extends Component
{
    private ListEditionsQuery $editionsQuery;

    public function boot(ListEditionsQuery $editionsQuery): void
    {
        $this->editionsQuery = $editionsQuery;
    }

    #[Computed]
    public function editions(): Collection
    {
        return $this->editionsQuery->all();
    }
}