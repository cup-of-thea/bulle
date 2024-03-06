<?php

namespace App\Domain\UseCases\Queries;

use App\Domain\Repositories\ITagsRepository;
use App\Domain\ValueObjects\Author;
use Illuminate\Support\Collection;

readonly final class GetTagsFromAuthorQuery
{
    public function __construct(private ITagsRepository $tagsRepository)
    {
    }

    public function get(Author $author): Collection
    {
        return $this->tagsRepository->getByAuthor($author);
    }
}