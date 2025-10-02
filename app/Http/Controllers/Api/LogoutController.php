<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
     protected $authService ;

    public function __construct(AuthService $authService ){
        $this->authService = $authService;
    }

    public function destroy(Request $request)
    {
       $user = $request->user();
       $logout =$this->authService->logout($user);
       return $logout ? ApiResponse::sendResponse(200,'success',[]):ApiResponse::sendResponse(401,'fail',[]);
       
       
    }

}
