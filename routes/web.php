<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

Route::get('/', [HomeController::class, 'index'])->name('home');
 //to get single  page with id
 Route::get('/post/{post:slug}', [PostController::class,'show'])->name('post.show');
 Route::post('/post/{post:slug}', [PostController::class,'addComment'])->name('add_comment');

Route::get('/about', function () {
    return view('about');
})->name('about');


Route::get('/contact', function () {
    return view('contact');
})->name('contact');
 
require __DIR__.'/auth.php';
