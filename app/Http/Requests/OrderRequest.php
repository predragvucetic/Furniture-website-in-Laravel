<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            "firstName" => "required|alpha|min:3|max:20",
            "lastName" => "required|alpha|min:4|max:30",
            "email" => "required|unique:customer,email|max:100|email",
            "country" => "required|min:2|max:50",
            "city" => "required|min:2|max:50",
            "postcode" => "required|min:3|max:30",
            "address" => "required|min:5|max:255"
        ];
    }
}
