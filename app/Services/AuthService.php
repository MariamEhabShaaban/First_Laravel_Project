<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function login($data){
            $user =Auth::attempt(['email' => $data['email'], 'password' =>$data['password']]);
       if($user){
        $user =Auth::user();
        $response['token']= $user->createToken('Blog')->plainTextToken;
        $response['name'] = $user->name;
        $response['email'] = $user->email;
        return $response;
    }
    return [];
}

public function register($data){
try{
        $user = User::create($data);
        $response['token']= $user->createToken('Blog')->plainTextToken;
        $response['name'] = $user->name;
        $response['email'] = $user->email;
        return $response;
} catch(\Exception $e){
    return [];
}
}


public function logout(User $user){
    $del = $user->currentAccessToken()->delete();
    return $del;
}



}
