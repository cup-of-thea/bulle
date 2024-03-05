<?php

namespace App\Domain\Repositories;

use Illuminate\Support\Collection;

interface ITagsRepository
{

    public function all(): Collection;
}
