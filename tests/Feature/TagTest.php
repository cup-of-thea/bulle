<?php

use App\Domain\ValueObjects\Tag;
use App\Domain\ValueObjects\TagId;
use App\Livewire\ShowTagComponent;
use Illuminate\Support\Facades\DB;

use function Pest\Livewire\livewire;

it('displays tags page', function () {
    $this->get(route('tags.index'))->assertStatus(200);
});

it('lists all tags', function () {
    DB::table('tags')->insert([
        ['title' => 'Tag 1', 'slug' => 'tag-1'],
        ['title' => 'Tag 3', 'slug' => 'tag-3'],
        ['title' => 'Tag 2', 'slug' => 'tag-2'],
    ]);

    $this->get(route('tags.index'))
        ->assertSeeInOrder(['Tag 1', 'Tag 2', 'Tag 3']);
});

it('displays tag details', function () {
    DB::table('tags')->insertGetId(['title' => 'Tag 1', 'slug' => 'tag-1']);

    $this->get(route('tags.show', 'tag-1'))
        ->assertSee('Tag 1')
        ->assertSeeLivewire(ShowTagComponent::class);
});

it('displays tag details with posts', function () {
    $id = DB::table('tags')->insertGetId(['title' => 'Tag 1', 'slug' => 'tag-1']);

    DB::table('posts')->insert([
        ['title' => 'Post 1', 'slug' => 'post-1', 'content' => 'Content 1', 'date' => now()],
        ['title' => 'Post 2', 'slug' => 'post-2', 'content' => 'Content 2', 'date' => now()],
    ]);

    $postIds = DB::table('posts')->pluck('id')->toArray();

    DB::table('post_tag')->insert([
        ['post_id' => $postIds[0], 'tag_id' => $id],
        ['post_id' => $postIds[1], 'tag_id' => $id],
    ]);

    livewire(
        ShowTagComponent::class,
        ['tag' => Tag::from(TagId::from($id), 'Tag 1', 'tag-1')]
    )
        ->assertSee('Tag 1')
        ->assertSee('Post 1')
        ->assertSee('Post 2');
});
