<?php

namespace App\Domain\UseCases\Queries;

use App\Domain\Repositories\IEditionsRepository;
use App\Domain\ValueObjects\Edition;

readonly class GetEditionFromSlugQuery
{
    public function __construct(private IEditionsRepository $editionsRepository)
    {
    }

    public function get(string $slug): ?Edition
    {
        return $this->editionsRepository->getEditionFromSlug($slug);
    }
}