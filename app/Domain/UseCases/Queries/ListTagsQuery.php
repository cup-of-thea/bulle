<?php

namespace App\Domain\UseCases\Queries;

use App\Domain\Repositories\ITagsRepository;
use Illuminate\Support\Collection;

readonly class ListTagsQuery
{
    public function __construct(private ITagsRepository $tagsRepository)
    {
    }

    public function all(): Collection
    {
        return $this->tagsRepository->all();
    }
}
