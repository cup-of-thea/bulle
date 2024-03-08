<?php

use App\Domain\Repositories\IAuthorsRepository;
use App\Domain\ValueObjects\AuthorItem;
use App\Livewire\ListAuthorsComponent;
use Illuminate\Support\Collection;

use function Pest\Livewire\livewire;

it('should return a list of authors', function () {
    $this->mock(IAuthorsRepository::class)
        ->shouldReceive('all')
        ->andReturn(
            Collection::make([
                AuthorItem::from(
                    'Jane Doe',
                    'jane-doe',
                    '/path/to/image.jpg',
                    2,
                    'My second post',
                    'my-second-post',
                    now(),
                ),
                AuthorItem::from(
                    'John Doe',
                    'john-doe',
                    '/path/to/image.jpg',
                    1,
                    'My first post',
                    'my-first-post',
                    now(),
                ),
            ])
        );

    livewire(ListAuthorsComponent::class)->assertSeeInOrder(['Jane Doe', 'John Doe']);
});
