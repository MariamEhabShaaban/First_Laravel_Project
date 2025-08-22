<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
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
       $this->middleware('auth')->only(['create','my_Blogs']);
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
        Blog::create($validateData);

        return back()->with('BlogCreateStatus','Your Blog added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {   
        
        
         return view('theme.single-blog',compact('blog'));
      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)

    { 
         if($blog->user_id == Auth::user()->id){
          $categories = Category::get();
          return view('theme.blogs.edit',compact('blog','categories'));
         }
         abort(403);
    }

    /**
     * Update the specified resource in storage.
     */
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
            $blog->update($validateData);

            return back()->with('BlogUpdateStatus','Your Blog updated successfully');
    }
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
          if($blog->user_id == Auth::user()->id){
                Storage::delete("public/blogs/$blog->image");
                $blog->delete();
                return back()->with('BlogDeleteStatus','Your Blog deleted successfully');
          }
          abort(403);
    }

    public function my_Blogs(){
        $blogs = Blog::where('user_id', Auth::user()->id)->paginate(10);
        return view('theme.blogs.my-blogs',compact('blogs'));
    }
}
