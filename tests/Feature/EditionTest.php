<?php

use App\Livewire\ShowEditionComponent;
use App\Models\Edition;
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
    $edition = Edition::factory()->create(['title' => 'Edition 1', 'slug' => 'edition-1']);

    $edition->posts()->createMany([
        ['title' => 'Post 1', 'slug' => 'post-1', 'content' => 'Content 1', 'date' => now()],
        ['title' => 'Post 2', 'slug' => 'post-2', 'content' => 'Content 2', 'date' => now()],
    ]);

    livewire(ShowEditionComponent::class, ['edition' => $edition])
        ->assertSee('Edition 1')
        ->assertSee('Post 1')
        ->assertSee('Post 2');
});
