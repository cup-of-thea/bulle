<?php

use App\Domain\Repositories\IPostsRepository;
use App\Domain\ValueObjects\Category;
use App\Domain\ValueObjects\CategoryId;
use App\Domain\ValueObjects\Edition;
use App\Domain\ValueObjects\EditionId;
use App\Domain\ValueObjects\Post;
use App\Livewire\GetLastPostsComponent;
use App\Models\Author;
use Carbon\Carbon;

use function Pest\Livewire\livewire;

it('displays last posts', function () {
    $this->mock(IPostsRepository::class)->shouldReceive('getLastPosts')->andReturn(collect([
        Post::from(
            'Post 3',
            'post-3',
            'Content 3',
            'file-path-3',
            new Carbon('2021-01-03'),
            Category::from(CategoryId::from(3), 'Category 3', 'category-3'),
            Edition::from(EditionId::from(1), 'Edition 1', 'edition-1'),
            collect([
                Author::factory()->make(['name' => 'Author 5', 'slug' => 'author-5']),
                Author::factory()->make(['name' => 'Author 6', 'slug' => 'author-6']),
            ]),
            [
                (object)['title' => 'Tag 5', 'slug' => 'tag-5'],
                (object)['title' => 'Tag 6', 'slug' => 'tag-6'],
            ],
            null,
        ),
        Post::from(
            'Post 2',
            'post-2',
            'Content 2',
            'file-path-2',
            new Carbon('2021-01-02'),
            Category::from(categoryId::from(2), 'Category 2', 'category-2'),
            Edition::from(EditionId::from(1), 'Edition 1', 'edition-1'),
            collect([
                Author::factory()->make(['name' => 'Author 3', 'slug' => 'author-3']),
                Author::factory()->make(['name' => 'Author 4', 'slug' => 'author-4']),
            ]),
            [
                (object)['title' => 'Tag 3', 'slug' => 'tag-3'],
                (object)['title' => 'Tag 4', 'slug' => 'tag-4'],
            ],
            null,
        ),
        Post::from(
            'Post 1',
            'post-1',
            'This is sparta',
            'This is sparta',
            new Carbon('2021-01-01'),
            Category::from(CategoryId::from(1), 'Category 1', 'category-1'),
            Edition::from(EditionId::from(1), 'Edition 1', 'edition-1'),
            collect([
                Author::factory()->make(['name' => 'Author 1', 'slug' => 'author-1']),
                Author::factory()->make(['name' => 'Author 2', 'slug' => 'author-2']),
            ]),
            [
                (object)['title' => 'Tag 1', 'slug' => 'tag-1'],
                (object)['title' => 'Tag 2', 'slug' => 'tag-2'],
            ],
            null,
        ),
    ]));

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
