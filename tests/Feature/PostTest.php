<?php

use App\Domain\Repositories\IPostsRepository;
use App\Domain\ValueObjects\Category;
use App\Domain\ValueObjects\CategoryId;
use App\Domain\ValueObjects\Edition;
use App\Domain\ValueObjects\EditionId;
use App\Domain\ValueObjects\Post;
use Carbon\Carbon;

it('displays post page', function () {
    $this->mock(IPostsRepository::class)
        ->shouldReceive('getPostFromSlug')
        ->with('my-first-post')
        ->andReturn(
            Post::from(
                'My first post',
                'my-first-post',
                'This is my first post',
                'loremp ipsum',
                new Carbon('2021-01-01'),
                Category::from(CategoryId::from(1), 'Category 1', 'category-1'),
                Edition::from(EditionId::from(1), 'Edition 1', 'edition-1'),
                [
                    (object)['name' => 'Author 1', 'slug' => 'author-1'],
                    (object)['name' => 'Author 2', 'slug' => 'author-2'],
                ],
                [
                    (object)['title' => 'Tag 1', 'slug' => 'tag-1'],
                    (object)['title' => 'Tag 2', 'slug' => 'tag-2'],
                ],
            )
        );

    $this->get(route('posts.show', ['slug' => 'my-first-post']))
        ->assertStatus(200)
        ->assertSee('My first post')
        ->assertSee('loremp ipsum')
        ->assertSee('This is my first post')
        ->assertSee(['Edition 1', route('editions.show', 'edition-1')])
        ->assertSee(['Category 1', route('categories.show', 'category-1')])
        ->assertSee(['Author 1', route('authors.show', 'author-1')])
        ->assertSee(['Author 2', route('authors.show', 'author-2')])
        ->assertSee(['Tag 1', route('tags.show', 'tag-1')])
        ->assertSee(['Tag 2', route('tags.show', 'tag-2')]);
});
