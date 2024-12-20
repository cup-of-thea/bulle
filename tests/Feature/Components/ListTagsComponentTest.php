<?php

use App\Livewire\ListTagsComponent;
use App\Models\Tag;

use function Pest\Livewire\livewire;

it('should return a list of tags', function () {
    Tag::factory()->create(['title' => 'Tag B', 'slug' => 'tag-b']);
    Tag::factory()->create(['title' => 'Tag C', 'slug' => 'tag-c']);

    livewire(ListTagsComponent::class)->assertSeeInOrder(['Tag B', 'Tag C']);
});
