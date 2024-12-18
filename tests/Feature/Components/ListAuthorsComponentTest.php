<?php

use App\Livewire\ListAuthorsComponent;
use App\Models\Author;
use App\Models\Post;

use function Pest\Livewire\livewire;

it('should return a list of authors', function () {
    $jane = Author::factory()->create(['name' => 'Jane Doe', 'slug' => 'jane-doe']);
    $john = Author::factory()->create(['name' => 'John Doe', 'slug' => 'john-doe']);

    Post::factory(3)->create()->each(function ($post) use ($jane) {
        $post->authors()->attach($jane->id);
    });

    Post::factory(2)->create()->each(function ($post) use ($john) {
        $post->authors()->attach($john->id);
    });

    $posts = Post::all();

    livewire(ListAuthorsComponent::class)->assertSeeInOrder(['Jane Doe', 'John Doe']);
});
