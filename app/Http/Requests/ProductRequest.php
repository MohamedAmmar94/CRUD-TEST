<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $images = 'image|mimes:jpeg,jpg,png,gif';
        $images_array = 'array|max:2';
        return [
            'title'=>'required',
            'description'=>'required',
            'price'=>'nullable',
            'category'=>'numeric|exists:categories,id',
            'images' => $images_array,
            'images.*' => $images,
        ];
    }
}
