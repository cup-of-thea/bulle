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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/articles', function () {
    return view('posts.index');
})->name('posts.index');

Route::get('/association', function () {
    return view('association');
})->name('association');

Route::get('/mentions-legales', function () {
    return view('legals');
})->name('legals');

Route::get('/auteur·rice·x·s', function () {
    return view('authors.index');
})->name('authors.index');
