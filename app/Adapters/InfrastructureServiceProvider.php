<?php

namespace App\Adapters;

use App\Adapters\Repositories\AuthorsRepository;
use App\Domain\Repositories\IAuthorsRepository;
use Illuminate\Support\ServiceProvider;

class InfrastructureServiceProvider extends ServiceProvider
{
    public array $bindings = [
        IAuthorsRepository::class => AuthorsRepository::class,
    ];
}
