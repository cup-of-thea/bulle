<?php

namespace App\Livewire;

use App\Domain\UseCases\Queries\GetCategoriesFromAuthorQuery;
use App\Domain\UseCases\Queries\GetEditionsFromAuthorQuery;
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
    private GetEditionsFromAuthorQuery $getEditionsFromAuthorQuery;
    private GetCategoriesFromAuthorQuery $getCategoriesFromAuthorQuery;

    public function boot(
        GetPostsFromAuthorQuery $getPostsFromAuthorQuery,
        GetEditionsFromAuthorQuery $getEditionsFromAuthorQuery,
        GetCategoriesFromAuthorQuery $getCategoriesFromAuthorQuery
    ): void {
        $this->getPostsFromAuthorQuery = $getPostsFromAuthorQuery;
        $this->getEditionsFromAuthorQuery = $getEditionsFromAuthorQuery;
        $this->getCategoriesFromAuthorQuery = $getCategoriesFromAuthorQuery;
    }

    #[Computed]
    public function posts(): Collection
    {
        return $this->getPostsFromAuthorQuery->get($this->author);
    }

    #[Computed]
    public function editions(): Collection
    {
        return $this->getEditionsFromAuthorQuery->get($this->author);
    }

    #[Computed]
    public function categories(): Collection
    {
        return $this->getCategoriesFromAuthorQuery->get($this->author);
    }
}