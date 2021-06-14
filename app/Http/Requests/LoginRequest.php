<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            "email" => "required|max:50|email",
            "password" => [ "required", "regex:/^[\S]{6,32}$/" ]
        ];
    }

    public function messages()
    {
        return [
            //"required" => "This field is required",
            "email.max" => "Maximum length for email is 50 characters",
            "password.regex" => "Password cannot have whitespace characters and must have more than 6 characters"
        ];
    }
}
