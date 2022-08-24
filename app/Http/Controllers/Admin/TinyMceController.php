<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TinyMceController extends Controller
{
    public function upload_tinymce_image(){

       /*  $file = request()->file('file');
        $filename = $file->getClientOriginalName();
        
        $path = $file->storeAs('tinymce_uploads', $filename,'public');
        return response()->json(['location'=> "/storage/$path"]); */

        $file= request()->file('file');
        $path= url('/uploads/').'/'.$file->getClientOriginalName();
        $imgpath=$file->move(public_path('/uploads/'),$file->getClientOriginalName());
        $fileNameToStore= $path;


        return json_encode(['location' => $fileNameToStore]);
    }
}
