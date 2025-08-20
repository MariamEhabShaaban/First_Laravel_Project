<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreContactRequest;

use App\Models\Contact;

class ContactController extends Controller
{
    //

     public function store(StoreContactRequest $request){
    
        $validatedData = $request->validated();
       
        Contact::create($validatedData);

         return back()->with('status-message','Send successfully');


    }
}
