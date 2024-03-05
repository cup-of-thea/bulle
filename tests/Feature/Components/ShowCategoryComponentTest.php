<?php

use App\Domain\UseCases\Queries\GetPostsFromCategoryQuery;
use App\Domain\ValueObjects\Category;
use App\Domain\ValueObjects\CategoryId;
use App\Domain\ValueObjects\PostItem;
use App\Livewire\ShowCategoryComponent;
use Illuminate\Support\Collection;
use Thea\MarkdownBlog\Domain\ValueObjects\Category as CategoryData;
use function Pest\Livewire\livewire;

it('should return category posts', function () {
    $this->mock(GetPostsFromCategoryQuery::class)
        ->shouldReceive('get')
        ->andReturn(Collection::make([
            PostItem::from(
                'Post from category A',
                'post-from-category-a',
                'Category A',
                'category-a',
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
                'Another from category A',
                'another-from-category-a',
                'Category A',
                'category-a',
                now(),
                CategoryData::from('Category A', 'category-a'),
                [
                    (object)['name' => 'Jane Doe', 'slug' => 'jane-doe'],
                ],
                [
                    (object)['title' => 'TagB', 'slug' => 'tagb'],
                ],
            ),
        ]));

    livewire(ShowCategoryComponent::class,
        ['category' => Category::from(CategoryId::from(1), 'Category A', 'category-a')])
        ->assertSeeInOrder(['Category A', 'Post from category A', 'Another from category A']);
});
