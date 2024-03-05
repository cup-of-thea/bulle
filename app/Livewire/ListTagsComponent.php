<?php

namespace App\Livewire;

use App\Domain\UseCases\Queries\ListTagsQuery;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ListTagsComponent extends Component
{
    private ListTagsQuery $tagsQuery;

    public function boot(ListTagsQuery $tagsQuery): void
    {
        $this->tagsQuery = $tagsQuery;
    }

    #[Computed]
    public function tags(): Collection
    {
        return $this->tagsQuery->all();
    }
}
