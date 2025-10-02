<?php

namespace App\Services;

use App\Models\Blog;
use App\Http\Resources\BlogResource;
use Exception;
class BlogService
{

     public function paginate($per_page){
        try{ $blogs = Blog::paginate($per_page);

        if($blogs->total() >$blogs->perPage()){
           return [
                'info'=>BlogResource::collection($blogs),
                'pagination'=>[
                    'current page'=>$blogs->currentPage(),
                    'per page'=>$blogs->perPage(),
                    'links'=>[
                        'first'=>$blogs->url(1),
                        'last'=>$blogs->url($blogs->lastPage())
                    ]
                ]
            ];
            }
        }
        catch(Exception $e){
            return [];
        }
        }

        public function latest(){
            try{
        $blogs = Blog::latest()->get();
        return $blogs;
            }catch (Exception $e) {
                return [];
                }
        }

        public function get_blogs_under_category($id){
                try{
                    $blogs = Blog::where('category_id',$id)->paginate(1);
                    return BlogResource::collection($blogs);
                }catch(Exception $e){
                    return [];
                }
        }

}