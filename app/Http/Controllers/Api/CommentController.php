<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request){
        $data = $request->validated();
            try{
                $comment  = Comment::create($data); 
                return ApiResponse::sendResponse(200,'success',$comment);
         
         }catch(Exception $e){
             return ApiResponse::sendResponse(422,'fail',[]);
        }
    }
           
}
