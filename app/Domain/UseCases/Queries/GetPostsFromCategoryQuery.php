<?php

namespace App\Domain\UseCases\Queries;

use App\Domain\Repositories\IPostsRepository;
use App\Domain\ValueObjects\Category;
use Illuminate\Support\Collection;

readonly class GetPostsFromCategoryQuery
{
    public function __construct(private IPostsRepository $postsRepository)
    {
    }

    public function get(Category $category): Collection
    {
        return $this->postsRepository->getPostsFromCategory($category);
    }
}
