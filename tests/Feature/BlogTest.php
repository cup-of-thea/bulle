<?php

it('shows the blog page', function () {
    $this->get(route('blog'))->assertStatus(200);
});

it('displays taxonomies', function () {
    $this->get(route('blog'))
        ->assertSee(route('categories.index'))
        ->assertSee(route('tags.index'));
});

it('displays posts', function () {
    $this->get(route('blog'))
        ->assertSeeLivewire(\App\Livewire\LastPosts::class);
});
