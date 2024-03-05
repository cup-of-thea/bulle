<?php

use App\Domain\Repositories\ITagsRepository;
use App\Domain\ValueObjects\TagItem;
use App\Livewire\ListTagsComponents;
use Illuminate\Support\Collection;
use function Pest\Livewire\livewire;

it('should return a list of categories', function () {
    $this->mock(ITagsRepository::class)
        ->shouldReceive('all')
        ->andReturn(Collection::make([
            TagItem::from(
                'Tag B',
                'tag-b',
                10,
                'Last post from tag B',
                'last-post-from-tag-b',
                now(),
                [
                    (object)['name' => 'Jane Doe', 'slug' => 'jane-doe'],
                ],
            ),
            TagItem::from(
                'Tag C',
                'tag-c',
                12,
                'Last post from tag C',
                'last-post-from-tag-c',
                now(),
                [
                    (object)['name' => 'Jane Doe', 'slug' => 'jane-doe'],
                    (object)['name' => 'John Doe', 'slug' => 'john-doe'],
                ],
            ),
        ]));

    livewire(ListTagsComponents::class)->assertSeeInOrder(['Tag B', 'Tag C']);
});
