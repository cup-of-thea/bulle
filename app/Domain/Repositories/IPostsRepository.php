<?php

namespace App\Domain\Repositories;

use App\Domain\ValueObjects\Category;
use Illuminate\Support\Collection;

interface IPostsRepository
{

    public function getPostsFromCategory(Category $category): Collection;

    public function getLastPosts(): Collection;
}
