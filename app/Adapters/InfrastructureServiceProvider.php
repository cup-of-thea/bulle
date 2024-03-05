<?php

namespace App\Adapters;

use App\Adapters\Repositories\AuthorsRepository;
use App\Adapters\Repositories\CategoriesRepository;
use App\Domain\Repositories\IAuthorsRepository;
use App\Domain\Repositories\ICategoriesRepository;
use Illuminate\Support\ServiceProvider;

class InfrastructureServiceProvider extends ServiceProvider
{
    public array $bindings = [
        IAuthorsRepository::class => AuthorsRepository::class,
        ICategoriesRepository::class => CategoriesRepository::class,
    ];
}
