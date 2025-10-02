<?php

namespace App\Http\Controllers\Api;

use Illuminate\View\View;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Api\LoginRequest;
use App\Providers\RouteServiceProvider;

class LoginController extends Controller
{


    protected $authService ;

    public function __construct(AuthService $authService ){
        $this->authService = $authService;
    }

    public function store(LoginRequest $request)
    {
       $validatedData = $request->validated();
       $user =$this->authService->login($validatedData);
       return $user ? ApiResponse::sendResponse(200,'success',$user):ApiResponse::sendResponse(401,'fail',[]);
       
       
    }

}
