<?php

namespace App\Livewire;

use App\Domain\UseCases\Queries\TagsQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Tags extends Component
{
    private TagsQuery $tagsQuery;

    public function boot(TagsQuery $tagsQuery): void
    {
        $this->tagsQuery = $tagsQuery;
    }

    #[Computed]
    public function tags(): Collection
    {
        return $this->tagsQuery->get();
    }

    public function render(): View
    {
        return view('livewire.tags');
    }
}
