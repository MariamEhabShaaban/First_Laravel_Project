<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ThemeController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\SubscriberController;
use App\Http\Controllers\Api\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// AUTH ROUTES
Route::post('/login',[LoginController::class,'store']);
Route::post('/register',[RegisteredUserController::class,'store']);
Route::post('/logout',[LogoutController::class,'destroy'])->middleware('auth:sanctum');


// THEME ROUTES
Route::controller(ThemeController::class)->group(function(){
    Route::get('/home','index');  
    Route::get('/category/{id}','category');  
});

// SUBSCRIBER ROUTES
Route::post('/subscriber/store',[SubscriberController::class,'store']);

// CONTACT ROUTES
Route::post('/contact/store',[ContactController::class,'store'])->name('contact.store');

// BLOGS ROUTES
Route::get('/my-blogs',[BlogController::class,'my_Blogs'])->middleware('auth:sanctum');
Route::resource('blogs', BlogController::class)->except('index')->middleware('auth:sanctum');

// COMMENT ROUTES
Route::post('/comments/store',[CommentController::class,'store'])->name('comments.store');