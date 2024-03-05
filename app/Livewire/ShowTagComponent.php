<?php

namespace App\Livewire;

use App\Domain\UseCases\Queries\GetPostsFromTagQuery;
use App\Domain\ValueObjects\Tag;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class ShowTagComponent extends Component
{
    #[Locked]
    public Tag $tag;

    private GetPostsFromTagQuery $getPostsFromTagQuery;

    public function boot(GetPostsFromTagQuery $getPostsFromTagQuery): void
    {
        $this->getPostsFromTagQuery = $getPostsFromTagQuery;
    }

    #[Computed]
    public function posts(): Collection
    {
        return $this->getPostsFromTagQuery->get($this->tag);
    }
}
