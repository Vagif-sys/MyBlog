<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\TinyMceController;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;


// frontend user routes

Route::get('/', [HomeController::class, 'index'])->name('home');
 //to get single  page with id
 Route::get('/post/{post:slug}', [PostController::class,'show'])->name('post.show');
 Route::post('/post/{post:slug}', [PostController::class,'addComment'])->name('add_comment');

Route::get('/about', AboutController::class)->name('about');


Route::get('/contact', [ContactController::class,'create'])->name('contact');
Route::post('/contact/store', [ContactController::class,'store'])->name('store');


Route::get('/categories/{category:slug}', [CategoryController::class,'show'])->name('categories.show');
Route::get('categories/', [CategoryController::class,'index'])->name('categories.index');

Route::get('/tags/{tag:name}', [TagController::class,'show'])->name('tags.show');
require __DIR__.'/auth.php';


//dashboard admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth','isadmin'])->group(function(){

    Route::get('/',[DashboardController::class,'index'])->name('index');
    Route::resource('posts', AdminPostController::class);
    Route::post('upload_tinymce_image',[TinyMceController::class,'upload_tinymce_image'])->name('upload_tinymce_image');
});
