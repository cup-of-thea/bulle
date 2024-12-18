<?php

use App\Domain\Repositories\IPostsRepository;
use App\Domain\ValueObjects\Category;
use App\Domain\ValueObjects\CategoryId;
use App\Domain\ValueObjects\Edition;
use App\Domain\ValueObjects\EditionId;
use App\Domain\ValueObjects\Post;
use App\Domain\ValueObjects\Tag;
use App\Domain\ValueObjects\TagId;
use App\Livewire\ShowTagComponent;
use App\Models\Author;
use Illuminate\Support\Collection;

use function Pest\Livewire\livewire;

it('should return tag posts', function () {
    $this->mock(IPostsRepository::class)
        ->shouldReceive('getPostsFromTag')
        ->andReturn(
            Collection::make([
                Post::from(
                    'Post from tag A',
                    'post-from-tag-a',
                    'Tag A',
                    'tag-a',
                    now(),
                    Category::from(CategoryId::from(1), 'Category A', 'category-a'),
                    Edition::from(EditionId::from(1), 'Edition 1', 'edition-1'),
                    collect(
                        [
                            Author::factory()->make(['name' => 'Author 1', 'slug' => 'author-1']),
                            Author::factory()->make(['name' => 'Author 2', 'slug' => 'author-2']),
                        ]
                    ),
                    [
                        (object)['title' => 'TagA', 'slug' => 'taga'],
                        (object)['title' => 'TagB', 'slug' => 'tagb'],
                    ],
                    null,
                ),
                Post::from(
                    'Another from tag A',
                    'another-from-tag-a',
                    'Tag A',
                    'tag-a',
                    now(),
                    Category::from(CategoryId::from(2), 'Category B', 'category-b'),
                    Edition::from(EditionId::from(1), 'Edition 1', 'edition-1'),
                    Author::factory(1)->make(['name' => 'Jane Doe', 'slug' => 'jane-doe']),
                    [
                        (object)['title' => 'TagA', 'slug' => 'taga'],
                    ],
                    null,
                ),
            ])
        );

    livewire(
        ShowTagComponent::class,
        ['tag' => Tag::from(TagId::from(1), 'Tag A', 'tag-a')]
    )
        ->assertSeeInOrder(['Tag A', 'Post from tag A', 'Another from tag A']);
});
