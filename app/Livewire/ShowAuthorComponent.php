<?php

namespace App\Livewire;

use App\Domain\UseCases\Queries\GetCategoriesFromAuthorQuery;
use App\Domain\UseCases\Queries\GetCoAuthorsFromAuthorQuery;
use App\Domain\UseCases\Queries\GetEditionsFromAuthorQuery;
use App\Domain\UseCases\Queries\GetTagsFromAuthorQuery;
use App\Models\Author;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class ShowAuthorComponent extends Component
{
    #[Locked]
    public Author $author;

    private GetEditionsFromAuthorQuery $getEditionsFromAuthorQuery;
    private GetCategoriesFromAuthorQuery $getCategoriesFromAuthorQuery;
    private GetTagsFromAuthorQuery $getTagsFromAuthorQuery;
    private GetCoAuthorsFromAuthorQuery $getCoAuthorsFromAuthorQuery;

    public function boot(
        GetEditionsFromAuthorQuery $getEditionsFromAuthorQuery,
        GetCategoriesFromAuthorQuery $getCategoriesFromAuthorQuery,
        GetTagsFromAuthorQuery $getTagsFromAuthorQuery,
        GetCoAuthorsFromAuthorQuery $getCoAuthorsFromAuthorQuery,
    ): void {
        $this->getEditionsFromAuthorQuery = $getEditionsFromAuthorQuery;
        $this->getCategoriesFromAuthorQuery = $getCategoriesFromAuthorQuery;
        $this->getTagsFromAuthorQuery = $getTagsFromAuthorQuery;
        $this->getCoAuthorsFromAuthorQuery = $getCoAuthorsFromAuthorQuery;
    }

    #[Computed]
    public function posts(): Collection
    {
        return $this->author->posts;
    }

    #[Computed]
    public function editions(): Collection
    {
        return $this->getEditionsFromAuthorQuery->get($this->author);
    }

    #[Computed]
    public function categories(): Collection
    {
        return $this->author->categories()->limit(500)->orderBy('title')->get();
    }

    #[Computed]
    public function tags(): Collection
    {
        return $this->getTagsFromAuthorQuery->get($this->author);
    }

    #[Computed]
    public function coAuthors(): Collection
    {
        return $this->getCoAuthorsFromAuthorQuery->get($this->author);
    }
}