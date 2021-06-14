<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            "username" => [ "required", "unique:user,username", "regex:/^[\S]{6,20}$/" ],
            "email" => "required|unique:user,email|max:50|email",
            "password" => [ "required", "regex:/^[\S]{6,32}$/" ]
        ];
    }

    public function messages()
    {
        return [
            //"required" => "This field is required",
            //"alpha" => "This field must have alphabetic characters",
            "firstName.min" => "Minimum length for first name is 3 characters",
            "firstName.max" => "Maximum length for first name is 20 characters",
            "lastName.min" => "Minimum length for last name is 4 characters",
            "lastName.max" => "Maximum length for last name is 30 characters",
            //"unique" => "This field must be unique",
            "username.regex" => "Username cannot have whitespace characters and must have more than 6 characters",
            "email.max" => "Maximum length for email is 50 characters",
            "password.regex" => "Password cannot have whitespace characters and must have more than 6 characters"
        ];
    }
}
