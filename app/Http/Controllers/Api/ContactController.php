<?php

namespace App\Http\Controllers\Api;

use Exception;

use App\Models\Contact;

use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;

class ContactController extends Controller
{
    

     public function store(StoreContactRequest $request){
    
        $validatedData = $request->validated();
       
        try{
             Contact::create($validatedData);
           return ApiResponse::sendResponse(201,'success',[]);

        }catch(Exception $e){
             return ApiResponse::sendResponse(422,'fail',[]);
        }
        

         


    }
}
