<?php

use App\Livewire\ListEditionsComponent;
use App\Models\Edition;

use function Pest\Livewire\livewire;

it('should return a list of editions', function () {
    Edition::factory()->create(['title' => 'Edition B', 'slug' => 'edition-b', 'updated_at' => now()->subDay(), 'status' => 'published']);
    Edition::factory()->create(['title' => 'Edition C', 'slug' => 'edition-c', 'updated_at' => now(), 'status' => 'published']);
    livewire(ListEditionsComponent::class)->assertSeeInOrder(['Edition C', 'Edition B']);
});
