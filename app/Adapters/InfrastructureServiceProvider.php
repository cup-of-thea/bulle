<?php

namespace App\Adapters;

use App\Adapters\Repositories\AuthorsRepository;
use App\Adapters\Repositories\CategoriesRepository;
use App\Adapters\Repositories\EditionsRepository;
use App\Adapters\Repositories\PostsRepository;
use App\Adapters\Repositories\TagsRepository;
use App\Domain\Repositories\IAuthorsRepository;
use App\Domain\Repositories\ICategoriesRepository;
use App\Domain\Repositories\IEditionsRepository;
use App\Domain\Repositories\IPostsRepository;
use App\Domain\Repositories\ITagsRepository;
use Illuminate\Support\ServiceProvider;

class InfrastructureServiceProvider extends ServiceProvider
{
    public array $bindings = [
        IAuthorsRepository::class => AuthorsRepository::class,
        ICategoriesRepository::class => CategoriesRepository::class,
        IEditionsRepository::class => EditionsRepository::class,
        IPostsRepository::class => PostsRepository::class,
        ITagsRepository::class => TagsRepository::class,
    ];
}
