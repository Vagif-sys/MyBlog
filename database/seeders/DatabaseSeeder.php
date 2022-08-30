<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Disbale foreign key  and  enable it again
        Schema::disableForeignKeyConstraints();

        \App\Models\User::truncate();
        \App\Models\Role::truncate();
        \App\Models\Category::truncate();
        \App\Models\Post::truncate();
        \App\Models\Comment::truncate();
        \App\Models\Tag::truncate();
        \App\Models\Image::truncate();
        Schema::disableForeignKeyConstraints();

        \App\Models\Role::factory(1)->create();
        \App\Models\Role::factory(1)->create(['name'=>'admin']);
         
        $blog_routes = Route::getRoutes();
        $permission_ids =[];
        foreach($blog_routes as $route){
            if(strpos($route->getName(),'admin') !== false){

                $permission = \App\Models\Permission::create(['name'=>$route->getName()]);
                $permission_ids[]=$permission->id;
            }
        }
        
        \App\Models\Role::where('name','admin')->first()->permissions()->sync($permission_ids);

        $users = \App\Models\User::factory(10)->create();
        //$users = \App\Models\User::factory()->create();
        foreach($users as $user){
            $user->image()->save(\App\Models\Image::factory()->make());
        } 

        

        //Create roles  and users
        \App\Models\Category::factory(10)->create();
        \App\Models\Category::factory()->create(['name'=> 'uncategorized']);
        $posts = \App\Models\Post::factory(10)->create();
        \App\Models\Comment::factory(100)->create();
        \App\Models\Tag::factory(10)->create();
        //\App\Models\Image::factory(10)->create();
         
          foreach($posts as $post){
            $tags_ids = [];
            $tags_ids[] = \App\Models\Tag::all()->random()->id;
            $tags_ids[] = \App\Models\Tag::all()->random()->id;
            $tags_ids[] = \App\Models\Tag::all()->random()->id;
            
            $post->tags()->sync($tags_ids);
            $post->image()->save(\App\Models\Image::factory()->make());
         }  
    }
}
