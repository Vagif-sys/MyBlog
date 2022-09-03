<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
class AdminContactController extends Controller
{
    public function index(){
        return view('admin_dashboard.contacts.index',[
            'contacts'=> Contact::all(),
        ]);
    }

    public function destroy(Contact $contact){
       
        $contact->delete();
        return redirect()->route('admin.contacts')->with('success','Contact has been deleted');
    }
}
