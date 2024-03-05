<?php

use App\Domain\ValueObjects\Category;
use App\Domain\ValueObjects\CategoryId;
use App\Livewire\ShowCategoryComponent;
use Illuminate\Support\Facades\DB;
use function Pest\Livewire\livewire;

it('displays categories page', function () {
    $this->get(route('categories.index'))->assertStatus(200);
});

it('lists all categories', function () {
    DB::table('categories')->insert([
        ['title' => 'Category 1', 'slug' => 'category-1'],
        ['title' => 'Category 3', 'slug' => 'category-3'],
        ['title' => 'Category 2', 'slug' => 'category-2'],
    ]);

    $this->get(route('categories.index'))
        ->assertSeeInOrder(['Category 1', 'Category 2', 'Category 3']);
});

it('displays category details', function () {
    $category = DB::table('categories')->insertGetId([
        'title' => 'Category 1',
        'slug' => 'category-1',
    ]);

    $this->get(route('categories.show', 'category-1'))
        ->assertSee('Category 1')
        ->assertSeeLivewire(ShowCategoryComponent::class);
});

it('displays category details with posts', function () {
    $id = DB::table('categories')->insertGetId(['title' => 'Category 1', 'slug' => 'category-1']);

    DB::table('posts')->insert([
        ['title' => 'Post 1', 'slug' => 'post-1', 'content' => 'Content 1', 'date' => now(), 'category_id' => $id, 'filePath' => 'file-path-1'],
        ['title' => 'Post 2', 'slug' => 'post-2', 'content' => 'Content 2', 'date' => now(), 'category_id' => $id, 'filePath' => 'file-path-2'],
    ]);

    livewire(
        ShowCategoryComponent::class,
        ['category' => Category::from(CategoryId::from($id), 'Category 1', 'category-1')]
    )
        ->assertSee('Category 1')
        ->assertSee('Post 1')
        ->assertSee('Post 2');
});
