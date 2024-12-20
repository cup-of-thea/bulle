<?php

use App\Livewire\ShowAuthorComponent;
use App\Models\Author;
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
    $author = Author::factory()
        ->create([
            'name' => 'author 1',
            'slug' => 'author-1',
            'bio' => 'A small bio',
            'title' => 'Software Engineer'
        ]);

    $author->links()->createMany([
        ['icon' => 'iconoir-twitter', 'url' => 'https://twitter.com/author-1'],
        ['icon' => 'iconoir-globe', 'url' => 'https://author-1.com'],
    ]);

    $author->posts()->create([
        'title' => 'Post 1',
        'slug' => 'post-1',
        'content' => 'Post 1 content',
        'date' => now(),
    ]);

    livewire(ShowAuthorComponent::class, ['author' => $author])
        ->assertSee('author 1')
        ->assertSee('Post 1')
        ->assertSee('A small bio')
        ->assertSee('Software Engineer')
        ->assertSee('https://twitter.com/author-1')
        ->assertSee('https://author-1.com');
});

it('gets permanent and guests authors', function () {
    $permanentAuthor = Author::factory()
        ->create([
            'name' => 'author 1',
            'slug' => 'author-1',
            'bio' => 'A small bio',
            'title' => 'Software Engineer',
            'permanent' => true,
        ]);

    $guestAuthor = Author::factory()
        ->create([
            'name' => 'author 2',
            'slug' => 'author-2',
            'bio' => 'A small bio',
            'title' => 'Software Engineer',
            'permanent' => false,
        ]);

    $permanentAuthors = Author::permanent()->get();

    expect($permanentAuthors->count())->toBe(1);
    expect($permanentAuthors->first()->id)->toBe($permanentAuthor->id);

    $guestAuthors = Author::guest()->get();

    expect($guestAuthors->count())->toBe(1);
    expect($guestAuthors->first()->id)->toBe($guestAuthor->id);
});
