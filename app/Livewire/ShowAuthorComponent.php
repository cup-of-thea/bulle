<?php

namespace App\Livewire;

use App\Domain\UseCases\Queries\GetPostsFromAuthorQuery;
use App\Domain\ValueObjects\Author;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class ShowAuthorComponent extends Component
{
    #[Locked]
    public Author $author;

    private GetPostsFromAuthorQuery $getPostsFromAuthorQuery;

    public function boot(GetPostsFromAuthorQuery $getPostsFromAuthorQuery): void
    {
        $this->getPostsFromAuthorQuery = $getPostsFromAuthorQuery;
    }

    #[Computed]
    public function posts(): Collection
    {
        return $this->getPostsFromAuthorQuery->get($this->author);
    }
}