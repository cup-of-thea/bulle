<?php

use App\Livewire\ListCategoriesComponent;
use App\Models\Category;

use function Pest\Livewire\livewire;

it('should return a list of categories', function () {
    Category::factory()->create(['title' => 'Category B', 'slug' => 'category-b']);
    Category::factory()->create(['title' => 'Category C', 'slug' => 'category-c']);

    livewire(ListCategoriesComponent::class)->assertSeeInOrder(['Category B', 'Category C']);
});
