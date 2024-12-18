<?php

use App\Domain\Repositories\ITagsRepository;
use App\Domain\ValueObjects\TagItem;
use App\Livewire\ListTagsComponent;
use App\Models\Author;
use Illuminate\Support\Collection;

use function Pest\Livewire\livewire;

it('should return a list of categories', function () {
    $this->mock(ITagsRepository::class)
        ->shouldReceive('all')
        ->andReturn(
            Collection::make([
                TagItem::from(
                    'Tag B',
                    'tag-b',
                    10,
                    'Last post from tag B',
                    'last-post-from-tag-b',
                    now(),
                    Author::factory(1)->create(),
                ),
                TagItem::from(
                    'Tag C',
                    'tag-c',
                    12,
                    'Last post from tag C',
                    'last-post-from-tag-c',
                    now(),
                    Author::factory(2)->create()
                ),
            ])
        );

    livewire(ListTagsComponent::class)->assertSeeInOrder(['Tag B', 'Tag C']);
});
