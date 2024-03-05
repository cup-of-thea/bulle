<?php

use App\Domain\Repositories\IPostsRepository;
use App\Domain\ValueObjects\PostItem;
use App\Livewire\GetLastPostsComponent;
use Carbon\Carbon;
use Thea\MarkdownBlog\Domain\ValueObjects\Category;
use function Pest\Livewire\livewire;

it('displays last posts', function () {
    $this->mock(IPostsRepository::class)->shouldReceive('getLastPosts')->andReturn(collect([
        PostItem::from(
            'Post 3',
            'post-3',
            'Content 3',
            'file-path-3',
            new Carbon('2021-01-03'),
            Category::from('Category 3', 'category-3'),
            [
                (object)['name' => 'Author 5', 'slug' => 'author-5'],
                (object)['name' => 'Author 6', 'slug' => 'author-6'],
            ],
            [
                (object)['title' => 'Tag 5', 'slug' => 'tag-5'],
                (object)['title' => 'Tag 6', 'slug' => 'tag-6'],
            ],
        ),
        PostItem::from(
            'Post 2',
            'post-2',
            'Content 2',
            'file-path-2',
            new Carbon('2021-01-02'),
            Category::from('Category 2', 'category-2'),
            [
                (object)['name' => 'Author 3', 'slug' => 'author-3'],
                (object)['name' => 'Author 4', 'slug' => 'author-4'],
            ],
            [
                (object)['title' => 'Tag 3', 'slug' => 'tag-3'],
                (object)['title' => 'Tag 4', 'slug' => 'tag-4'],
            ],
        ),
        PostItem::from(
            'Post 1',
            'post-1',
            'This is sparta',
            'This is sparta',
            new Carbon('2021-01-01'),
            Category::from('Category 1', 'category-1'),
            [
                (object)['name' => 'Author 1', 'slug' => 'author-1'],
                (object)['name' => 'Author 2', 'slug' => 'author-2'],
            ],
            [
                (object)['title' => 'Tag 1', 'slug' => 'tag-1'],
                (object)['title' => 'Tag 2', 'slug' => 'tag-2'],
            ],
        ),
    ]));

    livewire(GetLastPostsComponent::class)
        ->assertSeeInOrder([
            'Post 3',
            'Post 2',
            (new Carbon('2021-01-01'))->isoFormat('LL'),
            route('categories.show', 'category-1'),
            'Category 1',
            route('tags.show', 'tag-1'),
            '#Tag 1',
            route('tags.show', 'tag-2'),
            '#Tag 2',
            route('posts.show', 'post-1'),
            'Post 1',
            'This is sparta',
            route('authors.show', 'author-1'),
            'Author 1',
            route('authors.show', 'author-2'),
            'Author 2',
        ]);
});
