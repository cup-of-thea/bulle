<?php

use App\Livewire\ShowCategoryComponent;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

use function Pest\Livewire\livewire;

it('displays categories page', function () {
    $this->get(route('categories.index'))->assertStatus(200);
});

it('lists all categories', function () {
    $category1 = Category::factory()->create(['title' => 'Category 1', 'slug' => 'category-1']);
    $category2 = Category::factory()->create(['title' => 'Category 2', 'slug' => 'category-2']);
    $category3 = Category::factory()->create(['title' => 'Category 3', 'slug' => 'category-3']);

    $category1->posts()->create(['title' => 'Post 1', 'slug' => 'post-1', 'content' => 'Content 1', 'date' => now(), 'status' => 'published']);
    $category2->posts()->create(['title' => 'Post 2', 'slug' => 'post-2', 'content' => 'Content 2', 'date' => now(), 'status' => 'published']);
    $category3->posts()->create(['title' => 'Post 3', 'slug' => 'post-3', 'content' => 'Content 3', 'date' => now(), 'status' => 'published']);

    $this->get(route('categories.index'))
        ->assertSeeInOrder(['Category 1', 'Category 2', 'Category 3']);
});

it('displays category details', function () {
    DB::table('categories')->insertGetId(['title' => 'Category 1', 'slug' => 'category-1']);

    $this->get(route('categories.show', 'category-1'))
        ->assertSee('Category 1')
        ->assertSeeLivewire(ShowCategoryComponent::class);
});

it('displays category details with posts', function () {
    $id = DB::table('categories')->insertGetId(['title' => 'Category 1', 'slug' => 'category-1']);

    DB::table('posts')->insert([
        [
            'title' => 'Post 1',
            'slug' => 'post-1',
            'content' => 'Content 1',
            'date' => now(),
            'category_id' => $id,
            'status' => 'published',
        ],
        [
            'title' => 'Post 2',
            'slug' => 'post-2',
            'content' => 'Content 2',
            'date' => now(),
            'category_id' => $id,
            'status' => 'published',
        ],
    ]);

    livewire(
        ShowCategoryComponent::class,
        ['category' => Category::find($id)]
    )
        ->assertSee('Category 1')
        ->assertSee('Post 1')
        ->assertSee('Post 2');
});
