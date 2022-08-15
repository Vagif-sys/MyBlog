<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;

Route::get('/', [HomeController::class, 'index'])->name('home');
 //to get single  page with id
 Route::get('/post/{post:slug}', [PostController::class,'show'])->name('post.show');
 Route::post('/post/{post:slug}', [PostController::class,'addComment'])->name('add_comment');

Route::get('/about', AboutController::class)->name('about');


Route::get('/contact', [ContactController::class,'create'])->name('contact');
Route::post('/contact/store', [ContactController::class,'store'])->name('store');
 
require __DIR__.'/auth.php';
