<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriberController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// THEME ROUTES
Route::controller(ThemeController::class)->name("theme.")->group(function(){
    Route::get('/','index')->name('index');
    Route::get('/category/{id}','category')->name('category');
    Route::get('/contact','contact')->name('contact');

});
// SUBSCRIBER ROUTES
Route::post('/subscriber/store',[SubscriberController::class,'store'])->name('subscriber.store');

// CONTACT ROUTES
Route::post('/contact/store',[ContactController::class,'store'])->name('contact.store');

// BLOGS ROUTES
Route::get('/my-blogs',[BlogController::class,'my_Blogs'])->name('blogs.my-blogs');
Route::resource('blogs', BlogController::class);

// COMMENT ROUTES
Route::post('/comments/store',[CommentController::class,'store'])->name('comments.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
