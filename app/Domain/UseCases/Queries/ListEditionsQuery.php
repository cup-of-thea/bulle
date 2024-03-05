<?php

namespace App\Domain\UseCases\Queries;

use App\Domain\Repositories\IEditionsRepository;
use Illuminate\Support\Collection;

readonly class ListEditionsQuery
{
    public function __construct(private IEditionsRepository $editionsRepository)
    {
    }

    public function all(): Collection
    {
        return $this->editionsRepository->all();
    }
}