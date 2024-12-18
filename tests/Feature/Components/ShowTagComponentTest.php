<?php

use App\Livewire\ShowTagComponent;
use App\Models\Tag;

use function Pest\Livewire\livewire;

it('should return tag posts', function () {
    $tag = Tag::factory()->create(['title' => 'Tag A', 'slug' => 'tag-a']);

    $tag->posts()->createMany([
        ['title' => 'Post from tag A', 'slug' => 'post-from-tag-a', 'date' => '2021-01-01'],
        ['title' => 'Another from tag A', 'slug' => 'another-from-tag-a', 'date' => '2021-01-02'],
    ]);

    livewire(ShowTagComponent::class, ['tag' => $tag])
        ->assertSeeInOrder(['Tag A', 'Post from tag A', 'Another from tag A']);
});
