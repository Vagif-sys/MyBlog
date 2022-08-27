<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
class AdminTagController extends Controller
{
    public function index(){
        return view('admin_dashboard.tags.index',[
            
            'tags'=>Tag::with('posts')->paginate(5),
        ]);
    }

    public function show(Tag $tag)
    {
        return view('admin_dashboard.tags.show',[
            'tag'=> $tag
        ]);
    }


    public function destroy($tag)
    {
        $tag =Tag::where('id',$tag)->first();
        $tag->posts()->detach();
        $tag->delete();
        return redirect()->route('admin.tags.index')->with('success','Tag has been deleted');
    }
}
