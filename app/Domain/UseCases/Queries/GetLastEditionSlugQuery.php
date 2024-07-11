<?php

namespace App\Domain\UseCases\Queries;

use App\Domain\Repositories\IEditionsRepository;

readonly class GetLastEditionSlugQuery
{
    public function __construct(private IEditionsRepository $editionsRepository)
    {
    }

    public function get(): ?string
    {
        return $this->editionsRepository->getLastEditionSlug();
    }
}