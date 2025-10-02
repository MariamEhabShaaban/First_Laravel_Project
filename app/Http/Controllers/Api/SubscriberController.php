<?php

namespace App\Http\Controllers\Api;

use Exception;
use  App\Models\Subscriber;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SubscribeRequest;

class SubscriberController extends Controller
{

    public function store(SubscribeRequest $request){
        $validatedData = $request->validated();
        try{
            $sub = Subscriber::create($validatedData);
            return ApiResponse::sendResponse(201,'success',$sub);

        }catch(Exception $e){
             return ApiResponse::sendResponse(422,'fail',[]);
        }
    }
}
