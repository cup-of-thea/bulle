<?php

use App\Domain\Repositories\IPostsRepository;
use App\Domain\ValueObjects\PostItem;
use App\Domain\ValueObjects\Tag;
use App\Domain\ValueObjects\TagId;
use App\Livewire\ShowTagComponent;
use Illuminate\Support\Collection;
use Thea\MarkdownBlog\Domain\ValueObjects\Category as CategoryData;
use function Pest\Livewire\livewire;

it('should return tag posts', function () {
    $this->mock(IPostsRepository::class)
        ->shouldReceive('getPostsFromTag')
        ->andReturn(Collection::make([
            PostItem::from(
                'Post from tag A',
                'post-from-tag-a',
                'Tag A',
                'tag-a',
                now(),
                CategoryData::from('Category A', 'category-a'),
                [
                    (object)['name' => 'Jane Doe', 'slug' => 'jane-doe'],
                    (object)['name' => 'John Doe', 'slug' => 'john-doe'],
                ],
                [
                    (object)['title' => 'TagA', 'slug' => 'taga'],
                    (object)['title' => 'TagB', 'slug' => 'tagb'],
                ],
            ),
            PostItem::from(
                'Another from tag A',
                'another-from-tag-a',
                'Tag A',
                'tag-a',
                now(),
                CategoryData::from('Category B', 'category-b'),
                [
                    (object)['name' => 'Jane Doe', 'slug' => 'jane-doe'],
                ],
                [
                    (object)['title' => 'TagA', 'slug' => 'taga'],
                ],
            ),
        ]));

    livewire(ShowTagComponent::class,
        ['tag' => Tag::from(TagId::from(1), 'Tag A', 'tag-a')])
        ->assertSeeInOrder(['Tag A', 'Post from tag A', 'Another from tag A']);
});
