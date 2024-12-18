<?php

use App\Models\Author;
use App\Models\Category;
use App\Models\Edition;
use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;

it('displays post page', function () {
    $post = Post::factory()->create([
        'slug' => 'my-first-post',
        'title' => 'My first post',
        'content' => 'loremp ipsum',
        'description' => 'This is my first post',
        'date' => Carbon::parse('2021-01-01'),
        'category_id' => Category::factory()->create(['title' => 'Category 1', 'slug' => 'category-1'])->id,
        'edition_id' => Edition::factory()->create(['title' => 'Edition 1', 'slug' => 'edition-1'])->id
    ]);

    $post->authors()->attach([
        Author::factory()->create(['name' => 'Author 1', 'slug' => 'author-1'])->id,
        Author::factory()->create(['name' => 'Author 2', 'slug' => 'author-2'])->id
    ]);

    $post->tags()->attach([
        Tag::factory()->create(['title' => 'Tag 1', 'slug' => 'tag-1'])->id,
        Tag::factory()->create(['title' => 'Tag 2', 'slug' => 'tag-2'])->id
    ]);

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
        ->assertSee(['Tag 2', route('tags.show', 'tag-2')])
        ->assertSee(`<meta name="author" content="Author 1, Author 2"/>`)
        ->assertSee(`<meta name="description" content="This is my first post"/>`)
        ->assertSee(`<meta name="keywords" content="Tag 1, Tag 2"/>`)
        ->assertSee(`<meta property="og:article:published_time" content="2021-01-01"/>`)
        ->assertSee(`<meta property="og:article:author" content="Author 1, Author 2"/>`)
        ->assertSee(`<meta property="og:article:section" content="Category 1"/>`)
        ->assertSee(`<meta property="og:article:tag" content="Tag 1, Tag 2"/>`)
        ->assertSee(`<title>My first post</title>`)
        ->assertSee(`<link rel="canonical" href="https://canonical.com/my-first-post"/>`);
});
