<?php

use App\Domain\Repositories\IPostsRepository;
use App\Domain\ValueObjects\Category;
use App\Domain\ValueObjects\CategoryId;
use App\Domain\ValueObjects\Edition;
use App\Domain\ValueObjects\EditionId;
use App\Domain\ValueObjects\Post;
use App\Livewire\ShowCategoryComponent;
use App\Models\Author;
use Illuminate\Support\Collection;

use function Pest\Livewire\livewire;

it('should return category posts', function () {
    $this->mock(IPostsRepository::class)
        ->shouldReceive('getPostsFromCategory')
        ->andReturn(
            Collection::make([
                Post::from(
                    'Another from category A',
                    'another-from-category-a',
                    'Category A',
                    'category-a',
                    now(),
                    Category::from(CategoryId::from(1), 'Category A', 'category-a'),
                    Edition::from(EditionId::from(1), 'Edition 1', 'edition-1'),
                    Author::factory(1)->make(['name' => 'Jane Doe', 'slug' => 'jane-doe']),
                    [
                        (object)['title' => 'TagB', 'slug' => 'tagb'],
                    ],
                    null,
                ),
                Post::from(
                    'Post from category A',
                    'post-from-category-a',
                    'Category A',
                    'category-a',
                    now(),
                    Category::from(CategoryId::from(1), 'Category A', 'category-a'),
                    Edition::from(EditionId::from(1), 'Edition 1', 'edition-1'),
                    collect([
                        Author::factory()->make(['name' => 'Jane Doe', 'slug' => 'jane-doe']),
                        Author::factory()->make(['name' => 'John Doe', 'slug' => 'john-doe']),
                    ]),
                    [
                        (object)['title' => 'TagA', 'slug' => 'taga'],
                        (object)['title' => 'TagB', 'slug' => 'tagb'],
                    ],
                    null,
                ),
            ])
        );

    livewire(
        ShowCategoryComponent::class,
        ['category' => Category::from(CategoryId::from(1), 'Category A', 'category-a')]
    )
        ->assertSeeInOrder([
            'Another from category A',
            'Post from category A',
        ]);
});
