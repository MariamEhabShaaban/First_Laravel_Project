<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use App\Models\Category;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Services\BlogService;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;

class ThemeController extends Controller
{
    protected $blogService;
    protected $categoryService;

    public function __construct(BlogService $blogService,CategoryService $categoryService){
        $this->blogService = $blogService;
        $this->categoryService = $categoryService;
    }

    public function index(){
        $blogs =$this->blogService->paginate(1);
        $sliderBlogs = $this->blogService->latest();
        $data =['blogs'=>$blogs, 'sliderBlogs' => $sliderBlogs];
        return ($sliderBlogs  || $blogs)  ? ApiResponse::sendResponse(200,'success',$data):ApiResponse::sendResponse(200,'success',[]) ;
    }

    

      public function category($id){
          $category = $this->categoryService->get_category($id);
          $blogs = $this->blogService->get_blogs_under_category($id);
        
           $data =['category'=>$category , 'blogs' =>$blogs];
          return ($category) ? ApiResponse::sendResponse(200,'success',$data):ApiResponse::sendResponse(422,'fail',[]) ;
        
       
    }


}
