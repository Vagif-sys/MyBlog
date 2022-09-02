<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

use App\Models\User;
use App\Models\Role;
class AdminUserController extends Controller
{
   private $rules = [
     'name'=> 'required|min:3',
     'email'=> 'required|email|unique:users,email',
     'password'=> 'required|min:8|max:20',
     'image'=> 'required|file|mimes:jpg,png,svg,jpeg',
     'role_id' => 'required|numeric',
   ];
    public function index()
    {
        return view('admin_dashboard.users.index',[
            'users' => User::paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_dashboard.users.create',[
            'roles'=> Role::pluck('name','id'),
        ]);
    }

    public function store(Request $request)
    {
        

        $validated = $request->validate($this->rules);
        $validated['password'] = Hash::make($request->input('password'));
        $user= User::create($validated);
         
        
       
        
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

        if($request->hasFile('image')) {
            /* $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png,gif'
            ]); */

            //unlink(public_path('uploads/'.$photo_data->photo));

            $now = time();
            $ext = $request->file('image')->extension();
            $final_name = 'image_'.$now.'.'.$ext;
            $path = $request->file('image')->move(public_path('/uploads/images'),$final_name);
            
            $user->image()->create([
                'name'=>$final_name,
                'extension'=> $ext,
                'path'=>$path
            ]);
            
        }

        

        return redirect()->route('admin.users.create')->with('success','User has been created');
    }

    public function show(User $user)
    {
        return view('admin_dashboard.users.show',[
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
         return view('admin_dashboard.users.edit',[
            'user'=>$user,
            'roles'=> Role::pluck('name','id')
         ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->rules['password'] = 'nullable|min:3|max:20';
        $this->rules['email'] = ['required','email',Rule::unique('users')->ignore($user)];
        $validated = $request->validate($this->rules);
        if($validated['password']=== null){
             unset($validated['password']);
        }else
            $validated['password'] = Hash::make($request->input('password'));
        $user->update($validated);
        
       
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

        if($request->hasFile('image')) {
            /* $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png,gif'
            ]); */

            //unlink(public_path('uploads/'.$photo_data->photo));

            $now = time();
            $ext = $request->file('image')->extension();
            $final_name = 'image_'.$now.'.'.$ext;
            $path = $request->file('image')->move(public_path('/uploads/images'),$final_name);
            
            $user->image()->create([
                'name'=>$final_name,
                'extension'=> $ext,
                'path'=>$path
            ]);
            
        }

        

        return redirect()->route('admin.users.edit',$user)->with('success','User has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

       if($user->id == auth()->id()){
            return redirect()->back()->with('error','You cant  delete yourself');
        } 
        
        User::wherehas('role',function($query){
             $query->where('name','admin');
        })->first()->posts()->saveMany($user->posts);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success','User has been deleted');
    }
}
