<?php

namespace App\Livewire;

use App\Domain\UseCases\LastPostsQuery;
use App\Domain\ValueObjects\PostItem;
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
    /**
     * @return Collection<PostItem>
     */
    public function posts(): Collection
    {
        return $this->lastPostsQuery->get();
    }

    public function render(): View
    {
        return view('livewire.last-posts');
    }
}
