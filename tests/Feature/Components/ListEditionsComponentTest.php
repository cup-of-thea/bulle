<?php

use App\Domain\Repositories\IEditionsRepository;
use App\Domain\ValueObjects\EditionItem;
use App\Livewire\ListEditionsComponent;
use App\Models\Author;
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
                    Author::factory(1)->create()
                ),
                EditionItem::from(
                    'Edition C',
                    'edition-c',
                    12,
                    'Last post from edition C',
                    'last-post-from-edition-c',
                    now(),
                    Author::factory(2)->create()
                ),
            ])
        );

    livewire(ListEditionsComponent::class)->assertSeeInOrder(['Edition B', 'Edition C']);
});
