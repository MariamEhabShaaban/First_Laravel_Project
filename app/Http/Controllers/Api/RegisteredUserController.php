<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\View\View;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Api\RegisterRequest;

class RegisteredUserController extends Controller
{


     protected $authService ;

    public function __construct(AuthService $authService ){
        $this->authService = $authService;
    }
    public function store(RegisterRequest $request)
    {
        $user = $request->validated();
        $user = $this->authService->register($user);
        return $user ? ApiResponse::sendResponse(201,'success',$user):ApiResponse::sendResponse(422,'fail',[]);

    }

    
   
}
