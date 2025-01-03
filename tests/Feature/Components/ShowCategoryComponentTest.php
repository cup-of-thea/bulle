<?php

use App\Livewire\ShowCategoryComponent;
use App\Models\Category;

use function Pest\Livewire\livewire;

it('should return category posts', function () {
    $category = Category::factory()->create(['title' => 'Category A', 'slug' => 'category-a']);

    $category->posts()->createMany([
        ['title' => 'Post from category A', 'slug' => 'post-from-category-a', 'date' => '2021-01-01', 'status' => 'published'],
        ['title' => 'Another from category A', 'slug' => 'another-from-category-a', 'date' => '2021-01-02', 'status' => 'published'],
    ]);

    livewire(ShowCategoryComponent::class, ['category' => $category])
        ->assertSeeInOrder(['Another from category A', 'Post from category A']);
});
