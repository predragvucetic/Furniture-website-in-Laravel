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
        return [
            "name" => "required|max:60",
            "description" => "required",
            "size" => "required",
            "price" => "required|numeric",
            "newPrice" => "numeric|nullable",
            "category" => "required|not_in:0",
            "images" => "required|max:5000"
        ];
    }
}
