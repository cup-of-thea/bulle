<?php

use App\Domain\ValueObjects\Edition;
use App\Domain\ValueObjects\EditionId;
use App\Livewire\ShowEditionComponent;
use Illuminate\Support\Facades\DB;

use function Pest\Livewire\livewire;

it('displays editions page', function () {
    $this->get(route('editions.index'))->assertStatus(200);
});

it('lists all editions', function () {
    DB::table('editions')->insert([
        ['title' => 'Edition 1', 'slug' => 'edition-1'],
        ['title' => 'Edition 3', 'slug' => 'edition-3'],
        ['title' => 'Edition 2', 'slug' => 'edition-2'],
    ]);

    $this->get(route('editions.index'))
        ->assertSeeInOrder(['Edition 1', 'Edition 2', 'Edition 3']);
});

it('displays edition details', function () {
    DB::table('editions')->insertGetId(['title' => 'Edition 1', 'slug' => 'edition-1']);

    $this->get(route('editions.show', 'edition-1'))
        ->assertSee('Edition 1')
        ->assertSeeLivewire(ShowEditionComponent::class);
});

it('displays edition details with posts', function () {
    $id = DB::table('editions')->insertGetId(['title' => 'Edition 1', 'slug' => 'edition-1']);

    DB::table('posts')->insert([
        [
            'title' => 'Post 1',
            'slug' => 'post-1',
            'content' => 'Content 1',
            'date' => now(),
            'edition_id' => $id,
            'filePath' => 'file-path-1'
        ],
        [
            'title' => 'Post 2',
            'slug' => 'post-2',
            'content' => 'Content 2',
            'date' => now(),
            'edition_id' => $id,
            'filePath' => 'file-path-2'
        ],
    ]);

    livewire(
        ShowEditionComponent::class,
        ['edition' => Edition::from(EditionId::from($id), 'Edition 1', 'edition-1')]
    )
        ->assertSee('Edition 1')
        ->assertSee('Post 1')
        ->assertSee('Post 2');
});
