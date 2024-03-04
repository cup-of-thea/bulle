<?php

namespace App\Livewire;

use App\Domain\UseCases\Queries\AuthorsQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Authors extends Component
{
    private AuthorsQuery $authorsQuery;

    public function boot(AuthorsQuery $authorsQuery): void
    {
        $this->authorsQuery = $authorsQuery;
    }

    #[Computed]
    public function authors(): Collection
    {
        return $this->authorsQuery->get();
    }

    public function render(): View
    {
        return view('livewire.authors');
    }
}
