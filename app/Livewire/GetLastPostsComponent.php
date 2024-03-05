<?php

namespace App\Livewire;

use App\Domain\UseCases\Queries\GetLastPostsQuery;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class GetLastPostsComponent extends Component
{
    private GetLastPostsQuery $lastPostsQuery;

    public function boot(GetLastPostsQuery $lastPostsQuery): void
    {
        $this->lastPostsQuery = $lastPostsQuery;
    }

    #[Computed]
    public function posts(): Collection
    {
        return $this->lastPostsQuery->get();
    }
}
