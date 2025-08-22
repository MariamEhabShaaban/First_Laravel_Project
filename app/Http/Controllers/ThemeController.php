<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    //

    public function index(){
        $blogs =Blog::paginate(1);
        $sliderBlogs = Blog::latest()->get();
        return view('theme.index',compact('blogs','sliderBlogs'));
    }

      public function contact(){
        return view('theme.contact');
    }

      public function category($id){
        $categoryName = Category::find($id)->name; 
         $blogs = Blog::where('category_id',$id)->paginate(1);
        return view('theme.category',compact('blogs','categoryName'));
    }


}
