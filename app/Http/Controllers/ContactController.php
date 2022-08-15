<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contact;
class ContactController extends Controller
{
    public function create(){
        return view('contact');
    }

    public function store(){

        
        Contact::create(
            request()->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'subject'=>'nullable|min:5|max:50',
            'email' => 'required',
            'message' => 'required|min:5|max:500'
            ]),
        );
        
        return redirect()->route('contact')->with('success','Your Message Sent');
    }

    
}
