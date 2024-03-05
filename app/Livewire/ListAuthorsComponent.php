<?php

namespace App\Livewire;

use App\Domain\UseCases\Queries\AuthorsQuery;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ListAuthorsComponent extends Component
{
    private AuthorsQuery $authorsQuery;

    public function boot(AuthorsQuery $authorsQuery): void
    {
        $this->authorsQuery = $authorsQuery;
    }

    #[Computed]
    public function authors(): Collection
    {
        return $this->authorsQuery->all();
    }
}
