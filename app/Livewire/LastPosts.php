<?php

namespace App\Livewire;

use App\Domain\UseCases\Queries\LastPostsQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class LastPosts extends Component
{
    private LastPostsQuery $lastPostsQuery;

    public function boot(LastPostsQuery $lastPostsQuery): void
    {
        $this->lastPostsQuery = $lastPostsQuery;
    }

    #[Computed]
    public function posts(): Collection
    {
        return $this->lastPostsQuery->get();
    }

    public function render(): View
    {
        return view('livewire.last-posts');
    }
}
