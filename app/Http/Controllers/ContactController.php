<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\Contact;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function create(){
        return view('contact');
    }

    public function store(){

        
        $data = array();
        $data['success'] = 0;
        $data['errors'] = [];
        $rules = [
            'firstName' => 'required',
            'lastName' => 'required',
            'subject'=>'nullable|min:5|max:50',
            'email' => 'required',
            'message' => 'required|min:5|max:500'
        ];
        $validated = Validator::make(request()->all(),$rules);
        if($validated->fails()){
            $data["errors"]["firstName"] = $validated->errors()->first('firstName');
            $data["errors"]["lastName"] = $validated->errors()->first('lastName');
            $data["errors"]["email"] = $validated->errors()->first('email');
            $data["errors"]["subject"] = $validated->errors()->first('subject');
            $data["errors"]["message"] = $validated->errors()->first('message');
            
        }else{

            $attributes=$validated->validated();
            Contact::create($attributes);
            Mail::to('vagifhuseyn3@gmail.com')->send(new ContactMail(
                $attributes['firstName'],
                $attributes['lastName'],
                $attributes['subject'],
                $attributes['email'],
                $attributes['message'],
                      
            ));

            $data['success'] = 1;
            $data['message'] = 'Thank you for contacting with us ';
        }    
        
        return response()->json($data);
        //return redirect()->route('contact')->with('success','Your Message Sent');
    }

    
}
