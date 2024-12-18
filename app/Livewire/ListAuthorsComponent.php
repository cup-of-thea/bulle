<?php

namespace App\Livewire;

use App\Domain\UseCases\Queries\ListAuthorsQuery;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ListAuthorsComponent extends Component
{
    private ListAuthorsQuery $authorsQuery;

    public function boot(ListAuthorsQuery $authorsQuery): void
    {
        $this->authorsQuery = $authorsQuery;
    }

    #[Computed]
    public function authors(): Collection
    {
        $authors = $this->authorsQuery->all();
        return $this->authorsQuery->all();
    }
}
