<?php

namespace App\Livewire;

use App\Domain\UseCases\Queries\TagsQuery;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ListTagsComponents extends Component
{
    private TagsQuery $tagsQuery;

    public function boot(TagsQuery $tagsQuery): void
    {
        $this->tagsQuery = $tagsQuery;
    }

    #[Computed]
    public function tags(): Collection
    {
        return $this->tagsQuery->all();
    }
}
