<?php

it('shows the home page', function () {
    $this->get(route('home'))->assertStatus(200);
});

it('displays the header nav', function () {
    $this->get(route('home'))->assertSeeInOrder([
        route('home'),
        route('posts.index'),
        route('association')
    ]);
});

it('displays the footer nav', function () {
    $this->get(route('home'))->assertSeeInOrder([
        route('association'),
        route('authors.index'),
        route('legals'),
    ]);
});
