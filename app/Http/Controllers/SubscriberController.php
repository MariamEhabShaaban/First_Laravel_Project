<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Subscriber;

class SubscriberController extends Controller
{
    //


    public function store(Request $request){
        $validatedData = $request->validate([
            'email'=>['required' ,'email','unique:subscribers,email']
        ]);
        
        
        Subscriber::create($validatedData);

         return back()->with('status','Subscribed successfully');


    }
}
