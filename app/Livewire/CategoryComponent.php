<?php

namespace App\Livewire;

use App\Domain\UseCases\Queries\GetPostsFromCategoryQuery;
use App\Domain\ValueObjects\Category;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class CategoryComponent extends Component
{
    #[Locked]
    public Category $category;

    private GetPostsFromCategoryQuery $getPostsFromCategoryQuery;

    public function boot(GetPostsFromCategoryQuery $getPostsFromCategoryQuery): void
    {
        $this->getPostsFromCategoryQuery = $getPostsFromCategoryQuery;
    }

    #[Computed]
    public function posts(): Collection
    {
        return $this->getPostsFromCategoryQuery->get($this->category);
    }
}
