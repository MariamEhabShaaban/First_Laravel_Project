<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Category;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBlogRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateBlogRequest;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
       $this->middleware('auth:sanctum')->only(['create','my_Blogs']);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::get();
        return view('theme.blogs.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $validateData = $request->validated();
        // upload image
        // 1-get image
        $image = $request->image;
        // 2- change its current name
        $newImageName = time().'-'.$image->getClientOriginalName();
        // 3-move image to my project
        $image->storeAs('blogs',$newImageName,'public');
        // 4- save new name to database record
        $validateData['image'] = $newImageName;
        $validateData['user_id'] = Auth::user()->id;
        try{
         $blog = Blog::create($validateData);
               return ApiResponse::sendResponse(201,'success',$blog);

        }catch(Exception $e){
             return ApiResponse::sendResponse(422,'fail',[]);
        }
        


        
    }


    public function show(Blog $blog)
    {   
                
        
         return view('theme.single-blog',compact('blog'));
      
    }


    public function edit(Blog $blog)

    { 
         if($blog->user_id == Auth::user()->id){
             try{
          $categories = Category::get();
          return ApiResponse::sendResponse(200,'success',$categories);
         
         }catch(Exception $e){
             return ApiResponse::sendResponse(422,'fail',[]);
        }
    }

         return ApiResponse::sendResponse(403,'Unauthorized',[]);
    }


    public function update( UpdateBlogRequest $request, Blog $blog)
    {
        
        
       if($blog->user_id == Auth::user()->id){
            $validateData = $request->validated();
        
            // upload image
            if($request->hasFile('image')){
                // delete old image
                Storage::delete("public/blogs/$blog->image");
                    // 1-get image
                $image = $request->image;
                // 2- change its current name
                $newImageName = time().'-'.$image->getClientOriginalName();
                // 3-move image to my project
                $image->storeAs('blogs',$newImageName,'public');
                // 4- save new name to database record
                $validateData['image'] = $newImageName;
        
            }
          
    try{
    

               $blog->update($validateData);
               return ApiResponse::sendResponse(201,'success',$blog);

        }catch(Exception $e){
             return ApiResponse::sendResponse(422,'fail',[]);
        }
    }
     return ApiResponse::sendResponse(403,'Unauthorized',[]);

    }

  
    public function destroy(Blog $blog)
    {
          if($blog->user_id == Auth::user()->id){
                Storage::delete("public/blogs/$blog->image");
                try{
                     $blog->comments()->delete();
                    $del = $blog->delete();

               return ApiResponse::sendResponse(201,'success',[]);

        }catch(Exception $e){
             return ApiResponse::sendResponse(422,'fail',[]);
        }
         
          return ApiResponse::sendResponse(403,'Unauthorized',[]);
    }
}

    public function my_Blogs(Request $request){
        try{
        $blogs = Blog::where('user_id', $request->user()->id)->get();
               return ApiResponse::sendResponse(201,'success',$blogs);

        }catch(Exception $e){
             return ApiResponse::sendResponse(422,'fail',[]);
        }
        

    }
}
