<?php

use App\Domain\Repositories\ICategoriesRepository;
use App\Domain\ValueObjects\CategoryItem;
use App\Livewire\ListCategoriesComponent;
use App\Models\Author;
use Illuminate\Support\Collection;

use function Pest\Livewire\livewire;

it('should return a list of categories', function () {
    $this->mock(ICategoriesRepository::class)
        ->shouldReceive('all')
        ->andReturn(
            Collection::make([
                CategoryItem::from(
                    'Category B',
                    'category-b',
                    10,
                    'Last post from category B',
                    'last-post-from-category-b',
                    now(),
                    Author::factory(1)->make(),
                ),
                CategoryItem::from(
                    'Category C',
                    'category-c',
                    12,
                    'Last post from category C',
                    'last-post-from-category-c',
                    now(),
                    Author::factory(2)->make()
                ),
            ])
        );

    livewire(ListCategoriesComponent::class)->assertSeeInOrder(['Category B', 'Category C']);
});
