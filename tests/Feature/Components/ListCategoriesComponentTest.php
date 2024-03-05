<?php

use App\Domain\UseCases\Queries\CategoriesQuery;
use App\Domain\ValueObjects\CategoryItem;
use App\Livewire\ListCategoriesComponent;
use Illuminate\Support\Collection;
use function Pest\Livewire\livewire;

it('should return a list of categories', function () {
    $this->mock(CategoriesQuery::class)
        ->shouldReceive('get')
        ->andReturn(Collection::make([
            CategoryItem::from(
                'Category B',
                'category-b',
                10,
                'Last post from category B',
                'last-post-from-category-b',
                now(),
                [
                    (object)['name' => 'Jane Doe', 'slug' => 'jane-doe'],
                ],
            ),
            CategoryItem::from(
                'Category C',
                'category-c',
                12,
                'Last post from category C',
                'last-post-from-category-c',
                now(),
                [
                    (object)['name' => 'Jane Doe', 'slug' => 'jane-doe'],
                    (object)['name' => 'John Doe', 'slug' => 'john-doe'],
                ],
            ),
        ]));

    livewire(ListCategoriesComponent::class)->assertSeeInOrder(['Category B', 'Category C']);
});
