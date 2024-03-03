<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', fn() => view('welcome'))->name('home');

Route::get('/association', fn() => view('association'))->name('association');

Route::get('/mentions-legales', fn() => view('legals'))->name('legals');

Route::get('/auteur·rice·x·s', fn() => view('authors.index'))->name('authors.index');

Route::get('/articles', fn() => view('blog'))->name('blog');

Route::get('/articles/{slug}', fn() => view('posts.show'))->name('posts.show');

Route::get('/categories', fn() => view('categories.index'))->name('categories.index');

Route::get('/categories/{slug}', fn() => view('categories.show'))->name('categories.show');

Route::get('/tags', fn() => view('tags.index'))->name('tags.index');

Route::get('/auteur·rice·x·s/{slug}', fn() => view('authors.show'))->name('authors.show');
