<?php

namespace App\Domain\UseCases\Queries;

use App\Domain\Repositories\ITagsRepository;
use App\Domain\ValueObjects\Tag;

readonly class GetTagFromSlugQuery
{
    public function __construct(private ITagsRepository $tagsRepository)
    {
    }

    public function get(string $slug): ?Tag
    {
        return $this->tagsRepository->getTagFromSlug($slug);
    }
}
