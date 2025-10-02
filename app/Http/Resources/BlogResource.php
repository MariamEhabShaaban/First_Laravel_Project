<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
             "id" =>$this->id,
                "name" => $this->name,
                "description" => $this->description,
                "image"=> $this->image,
                "category"=> $this->category,
                "user" =>$this->user,
                "created_at" =>  $this->create_at,
                "updated_at" => $this->update_at
        ];
    }
}
