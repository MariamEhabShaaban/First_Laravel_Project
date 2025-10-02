<?php

namespace App\Services;

use Exception;
use App\Models\User;
use App\Models\Category;
use App\Helpers\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CategoryService{


    public function get_category($id){
        try{
            $categoryName = Category::find($id)->name; 
            return $categoryName;
        }catch(Exception $e){
            return null ;
        }
    }
}