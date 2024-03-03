<?php

use function Pest\Livewire\livewire;

it('displays last posts', function () {
    \Illuminate\Support\Facades\DB::table('posts')->insert([
        ['title' => 'Post 1', 'slug' => 'post-1', 'filePath' => 'file-path-1', 'content' => 'Content 1', 'date' => '2021-01-01', 'created_at' => now(), 'updated_at' => now()],
        ['title' => 'Post 2', 'slug' => 'post-2', 'filePath' => 'file-path-2', 'content' => 'Content 2', 'date' => '2021-01-02', 'created_at' => now(), 'updated_at' => now()],
        ['title' => 'Post 3', 'slug' => 'post-3', 'filePath' => 'file-path-3', 'content' => 'Content 3', 'date' => '2021-01-03', 'created_at' => now(), 'updated_at' => now()],
    ]);
    livewire(\App\Livewire\LastPosts::class)
        ->assertSee('Post 3')
        ->assertSee('Post 2')
        ->assertSee('Post 1');
});

it('displays post details', function () {
    \Illuminate\Support\Facades\DB::table('categories')->insert([
        ['title' => 'Category 1', 'slug' => 'category-1', 'created_at' => now(), 'updated_at' => now()],
    ]);

    \Illuminate\Support\Facades\DB::table('authors')->insert([
        ['id' => 1, 'name' => 'Author 1', 'slug' => 'author-1', 'created_at' => now(), 'updated_at' => now()],
        ['id' => 2, 'name' => 'Author 2', 'slug' => 'author-2', 'created_at' => now(), 'updated_at' => now()],
    ]);

    \Illuminate\Support\Facades\DB::table('posts')->insert(
        ['id' => 1, 'title' => 'Post 1', 'slug' => 'post-1', 'filePath' => 'file-path-1', 'content' => 'Content 1', 'date' => '2021-01-01', 'category_id' => 1, 'created_at' => now(), 'updated_at' => now()],
    );

    \Illuminate\Support\Facades\DB::table('post_author')->insert([
        ['post_id' => 1, 'author_id' => 1, 'created_at' => now(), 'updated_at' => now()],
        ['post_id' => 1, 'author_id' => 2, 'created_at' => now(), 'updated_at' => now()],
    ]);

    // @todo: thea/markdown-blog add description field
    livewire(\App\Livewire\LastPosts::class)
        ->assertSeeInOrder([
            \Carbon\Carbon::createFromFormat('Y-m-d', '2021-01-01')->format('LLL'),
            'Category 1',
            route('posts.show', 'post-1'),
            'Post 1',
            'Author 1',
            'Author 2',
        ]);
});
