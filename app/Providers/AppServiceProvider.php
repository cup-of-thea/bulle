<?php

namespace App\Providers;

use App\Models\Author;
use App\Models\AuthorLink;
use App\Models\Post;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Author::unguard();
        AuthorLink::unguard();
        Post::unguard();
    }
}
