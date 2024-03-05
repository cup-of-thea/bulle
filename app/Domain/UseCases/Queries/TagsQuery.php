<?php

namespace App\Domain\UseCases\Queries;

use App\Domain\Repositories\ITagsRepository;
use Illuminate\Support\Collection;

class TagsQuery
{
    public function __construct(private readonly ITagsRepository $tagsRepository)
    {
    }

    public function all(): Collection
    {
        return $this->tagsRepository->all();
    }
}
