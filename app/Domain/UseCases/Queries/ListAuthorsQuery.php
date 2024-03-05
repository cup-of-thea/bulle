<?php

namespace App\Domain\UseCases\Queries;

use App\Domain\Repositories\IAuthorsRepository;
use Illuminate\Support\Collection;

readonly class ListAuthorsQuery
{
    public function __construct(private IAuthorsRepository $authorsRepository)
    {
    }

    public function all(): Collection
    {
        return $this->authorsRepository->all();
    }
}
