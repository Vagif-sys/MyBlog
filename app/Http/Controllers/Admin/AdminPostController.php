<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class AdminPostController extends Controller
{
   private $rules = [
      
      'title'=> 'required|max:100',
      'slug'=> 'required|max:100',
      'desc'=> 'required|max:100',
      'category_id'=> 'required|numeric',
      'thumbnail'=> 'required|file|mimes:jpg,png,svg,jpeg',
      'body'=> 'required',
   ];
    public function index()
    {
        return view('admin_dashboard.posts.index',[
             'posts'=> Post::with('category')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    
        
        return view('admin_dashboard.posts.create',[
            'categories'=> Category::pluck('name','id')
        ]);
    }

   
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);
        $validated['user_id'] = auth()->id();
        $post= Post::create($validated);
        
       /*  if($request->hasFile('thumbnail')){
            $thumbnail = $request->file('thumbnail');
            $filename =  $thumbnail->getClientOriginalName();
            $file_extension = $thumbnail->getClientOriginalExtension();
            $path = $thumbnail->move(public_path('uploads/images'), $filename.'.'.$file_extension);
            
            $post->image()->create([
                'name'=>$filename,
                'extension'=> $file_extension,
                'path'=>$path
            ]);

        } */

        if($request->hasFile('thumbnail')) {
            /* $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png,gif'
            ]); */

            //unlink(public_path('uploads/'.$photo_data->photo));

            $now = time();
            $ext = $request->file('thumbnail')->extension();
            $final_name = 'thumbnail_'.$now.'.'.$ext;
            $path = $request->file('thumbnail')->move(public_path('/uploads/images'),$final_name);
            
            $post->image()->create([
                'name'=>$final_name,
                'extension'=> $ext,
                'path'=>$path
            ]);
            
        }

        return redirect()->route('admin.posts.create')->with('success','Post has been created');
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit(Post $post)
    {
        return view('admin_dashboard.posts.edit',[
            'post'=> $post,
            'categories'=> Category::pluck('name','id')
        ]);
    }

  
    public function update(Request $request, Post $post)
    {
        $this->rules['thumbnail'] = 'nullable|file|mimes:jpg,png,svg,jpeg';
        $validated = $request->validate($this->rules);
        
        $post->update($validated);

        if($request->hasFile('thumbnail')) {
            /* $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png,gif'
            ]); */

            //unlink(public_path('uploads/'.$photo_data->photo));

            $now = time();
            $ext = $request->file('thumbnail')->extension();
            $final_name = 'thumbnail_'.$now.'.'.$ext;
            $path = $request->file('thumbnail')->move(public_path('uploads/images'),$final_name);
            
            $post->image()->update([
                'name'=>$final_name,
                'extension'=> $ext,
                'path'=>$path
            ]);
        }

        return redirect()->route('admin.posts.edit',$post)->with('success','Post has been updated');
    }

   
    public function destroy($post)
    {
        $post =Post::where('id',$post)->first();
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success','Post has benn deleted');
    }
}
