<?php

use App\Domain\UseCases\Queries\AuthorsQuery;
use App\Domain\ValueObjects\AuthorItem;
use App\Livewire\ListAuthorsComponent;
use Illuminate\Support\Collection;
use function Pest\Livewire\livewire;

it('should return a list of authors', function () {
    $authorsQuery = $this->mock(AuthorsQuery::class);
    $authorsQuery->shouldReceive('get')->andReturn(Collection::make([
        AuthorItem::from(
            'Jane Doe',
            'jane-doe',
            2,
            'My second post',
            'my-second-post',
            now(),
        ),
        AuthorItem::from(
            'John Doe',
            'john-doe',
            1,
            'My first post',
            'my-first-post',
            now(),
        ),
    ]));

    livewire(ListAuthorsComponent::class)->assertSeeInOrder(['Jane Doe', 'John Doe']);
});
