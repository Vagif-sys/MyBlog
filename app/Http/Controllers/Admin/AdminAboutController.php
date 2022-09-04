<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Setting;
class AdminAboutController extends Controller
{
    public function edit(){
        return view('admin_dashboard.about.edit',[
            'setting'=>Setting::find(1),
        ]);
    }


    public function update(){

        $validated = request()->validate([
            'first_text' => 'required|min:50,max:500',
            'second_text' => 'required|min:50,max:500',
            'our_vision' => 'required',
            'our_mission' => 'required',
            'about_services' => 'required',
            'first_image' => 'nullable|image',
            'second_image' => 'nullable|image', 
        ]);

        if(request()->hasFile('first_image')) {

            $now = time();
            $ext = request()->file('first_image')->extension();
            $final_name = 'first_image_'.$now.'.'.$ext;
            $path = request()->file('first_image')->move('public\uploads\settings',$final_name);
            $validated['first_image']= $path; 
        }

        if(request()->hasFile('second_image')) {

            $now = time();
            $ext = request()->file('second_image')->extension();
            $final_name = 'second_image_'.$now.'.'.$ext;
            $path = request()->file('second_image')->move('public\uploads\settings',$final_name);
            $validated['second_image']= $path; 
        }

        Setting::find(1)->update($validated);
        return redirect()->route('admin.about.edit')->with('success','Settings has been updated');
    }
}
