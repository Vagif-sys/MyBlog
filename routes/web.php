<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Image;
Route::get('/insert',function(){

    //$comment = Comment::create(['the_comment'=>'hello','post_id'=>1,'user_id'=>1]);

    
});

Route::get('/insert2',function(){
   
     /* $user = User::find(1);
     return $user->comments;

     $comment = Comment::find(1);
     return $comment->user; */

     $image = Image::find(1);
    
      dd($image->imagable); 


      
        
        
});


Route::get('/', function () {
    return view('home');
})->name('home');
 Route::get('/post', function () {
    return view('post');
})->name('post');

Route::get('/about', function () {
    return view('about');
})->name('about');


Route::get('/contact', function () {
    return view('contact');
})->name('contact');
 
require __DIR__.'/auth.php';
