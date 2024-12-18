<?php

use App\Domain\Repositories\IPostsRepository;
use App\Livewire\GetLastPostsComponent;
use App\Models\Author;
use App\Models\Category;
use App\Models\Edition;
use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;

use function Pest\Livewire\livewire;

it('displays last posts', function () {
    $post1 = Post::factory()->create([
        'title' => 'Post 1',
        'slug' => 'post-1',
        'description' => 'This is sparta',
        'edition_id' => Edition::factory()->create(['title' => 'Edition 1', 'slug' => 'edition-1'])->id,
        'category_id' => Category::factory()->create(['title' => 'Category 1', 'slug' => 'category-1'])->id,
        'date' => new Carbon('2021-01-01'),
    ]);
    Post::factory()->create([
        'title' => 'Post 2',
        'date' => new Carbon('2021-01-02'),
    ]);
    Post::factory()->create([
        'title' => 'Post 3',
        'date' => new Carbon('2021-01-03'),
    ]);

    $tags = collect([
        Tag::factory()->create(['title' => 'Tag 1', 'slug' => 'tag-1']),
        Tag::factory()->create(['title' => 'Tag 2', 'slug' => 'tag-2']),
    ])->pluck('id');
    $post1->tags()->attach($tags);
    $authors = collect([
        Author::factory()->create(['name' => 'Author 1', 'slug' => 'author-1']),
        Author::factory()->create(['name' => 'Author 2', 'slug' => 'author-2']),
    ])->pluck('id');
    $post1->authors()->attach($authors);

    livewire(GetLastPostsComponent::class)
        ->assertSeeInOrder(['Post 3', 'Post 2', 'Post 1'])
        ->assertSee([
            route('editions.show', 'edition-1'),
            'Edition 1',
            (new Carbon('2021-01-01'))->isoFormat('LL'),
            route('categories.show', 'category-1'),
            'Category 1',
            route('tags.show', 'tag-1'),
            '#Tag 1',
            route('tags.show', 'tag-2'),
            '#Tag 2',
            route('authors.show', 'author-1'),
            route('authors.show', 'author-2'),
            route('posts.show', 'post-1'),
            'Post 1',
            'This is sparta',
        ]);
});
