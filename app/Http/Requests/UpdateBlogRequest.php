<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use App\Helpers\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UpdateBlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name'=>'required|string',
            'description'=>'required',
            'category_id'=>'required|exists:categories,id',
            'image'=>'nullable|mimes:png,jpg' 
        ];

         if (in_array($this->method(), ['PUT', 'PATCH'])) {
        $rules['name']        = 'sometimes|required|string';
        $rules['description'] = 'sometimes|required|string';
        $rules['category_id'] = 'sometimes|required|exists:categories,id';
    }

    return $rules;
    }

    public function attributes(){
        return [
            'category_id'=>'category'

        ];
    }
}
