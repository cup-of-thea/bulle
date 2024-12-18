<?php

use App\Domain\Repositories\IPostsRepository;
use App\Domain\ValueObjects\Category;
use App\Domain\ValueObjects\CategoryId;
use App\Domain\ValueObjects\Edition;
use App\Domain\ValueObjects\EditionId;
use App\Domain\ValueObjects\Post;
use App\Domain\ValueObjects\Tag;
use App\Domain\ValueObjects\TagId;
use App\Livewire\ShowAuthorComponent;
use App\Models\Author;
use App\Models\AuthorLink;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use function Pest\Livewire\livewire;

it('displays authors page', function () {
    $this->get(route('authors.index'))->assertStatus(200);
});

it('lists all authors', function () {
    DB::table('authors')->insert([
        ['name' => 'author 1', 'slug' => 'author-1'],
        ['name' => 'author 3', 'slug' => 'author-3'],
        ['name' => 'author 2', 'slug' => 'author-2'],
    ]);

    $this->get(route('authors.index'))
        ->assertSeeInOrder(['author 1', 'author 2', 'author 3']);
});

it('displays author details', function () {
    DB::table('authors')->insertGetId(['name' => 'author 1', 'slug' => 'author-1']);

    $this->get(route('authors.show', 'author-1'))
        ->assertSee('author 1')
        ->assertSeeLivewire(ShowAuthorComponent::class);
});

it('displays author details with posts', function () {
    $id = Author::factory()
        ->create([
            'name' => 'author 1',
            'slug' => 'author-1',
            'bio' => 'A small bio',
            'title' => 'Software Engineer'
        ])->id;

    AuthorLink::factory()->create([
        'author_id' => $id,
        'icon' => 'iconoir-twitter',
        'url' => 'https://twitter.com/author-1',
    ]);

    AuthorLink::factory()->create([
        'author_id' => $id,
        'icon' => 'iconoir-globe',
        'url' => 'https://author-1.com',
    ]);

    $author = Author::find($id);

    $this->mock(IPostsRepository::class, function ($mock) use ($author) {
        $mock->shouldReceive('getPostsByAuthor')
            ->with($author)
            ->andReturn(
                collect([
                    Post::from(
                        'Post 1',
                        'post-1',
                        'Post 1 description',
                        'Post 1 content',
                        new Carbon('2021-01-01'),
                        Category::from(CategoryId::from(1), 'category 1', 'category-1'),
                        Edition::from(EditionId::from(1), 'edition 1', 'edition-1'),
                        collect([$author]),
                        [Tag::from(TagId::from(1), 'tag 1', 'tag-1')],
                        'https://category-1.com',
                    ),
                ])
            );
    });

    livewire(ShowAuthorComponent::class, ['author' => $author])
        ->assertSee('author 1')
        ->assertSee('Post 1')
        ->assertSee('A small bio')
        ->assertSee('Software Engineer')
        ->assertSee('https://twitter.com/author-1')
        ->assertSee('https://author-1.com');
});
