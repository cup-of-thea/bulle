<?php

use App\Domain\Repositories\IEditionsRepository;
use App\Domain\ValueObjects\EditionItem;
use App\Livewire\ListEditionsComponent;
use Illuminate\Support\Collection;

use function Pest\Livewire\livewire;

it('should return a list of editions', function () {
    $this->mock(IEditionsRepository::class)
        ->shouldReceive('all')
        ->andReturn(
            Collection::make([
                EditionItem::from(
                    'Edition B',
                    'edition-b',
                    10,
                    'Last post from edition B',
                    'last-post-from-edition-b',
                    now(),
                    [
                        (object)['name' => 'Jane Doe', 'slug' => 'jane-doe'],
                    ],
                ),
                EditionItem::from(
                    'Edition C',
                    'edition-c',
                    12,
                    'Last post from edition C',
                    'last-post-from-edition-c',
                    now(),
                    [
                        (object)['name' => 'Jane Doe', 'slug' => 'jane-doe'],
                        (object)['name' => 'John Doe', 'slug' => 'john-doe'],
                    ],
                ),
            ])
        );

    livewire(ListEditionsComponent::class)->assertSeeInOrder(['Edition B', 'Edition C']);
});
