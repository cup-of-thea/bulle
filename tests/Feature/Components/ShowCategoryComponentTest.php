<?php

use App\Domain\Repositories\IPostsRepository;
use App\Domain\ValueObjects\Category;
use App\Domain\ValueObjects\CategoryId;
use App\Domain\ValueObjects\Edition;
use App\Domain\ValueObjects\EditionId;
use App\Domain\ValueObjects\Post;
use App\Livewire\ShowCategoryComponent;
use Illuminate\Support\Collection;

use function Pest\Livewire\livewire;

it('should return category posts', function () {
    $this->mock(IPostsRepository::class)
        ->shouldReceive('getPostsFromCategory')
        ->andReturn(
            Collection::make([
                Post::from(
                    'Post from category A',
                    'post-from-category-a',
                    'Category A',
                    'category-a',
                    now(),
                    Category::from(CategoryId::from(1), 'Category A', 'category-a'),
                    Edition::from(EditionId::from(1), 'Edition 1', 'edition-1'),
                    [
                        (object)['name' => 'Jane Doe', 'slug' => 'jane-doe'],
                        (object)['name' => 'John Doe', 'slug' => 'john-doe'],
                    ],
                    [
                        (object)['title' => 'TagA', 'slug' => 'taga'],
                        (object)['title' => 'TagB', 'slug' => 'tagb'],
                    ],
                ),
                Post::from(
                    'Another from category A',
                    'another-from-category-a',
                    'Category A',
                    'category-a',
                    now(),
                    Category::from(CategoryId::from(1), 'Category A', 'category-a'),
                    Edition::from(EditionId::from(1), 'Edition 1', 'edition-1'),
                    [
                        (object)['name' => 'Jane Doe', 'slug' => 'jane-doe'],
                    ],
                    [
                        (object)['title' => 'TagB', 'slug' => 'tagb'],
                    ],
                ),
            ])
        );

    livewire(
        ShowCategoryComponent::class,
        ['category' => Category::from(CategoryId::from(1), 'Category A', 'category-a')]
    )
        ->assertSeeInOrder(['Category A', 'Post from category A', 'Another from category A']);
});
