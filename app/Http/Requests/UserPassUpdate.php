<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserPassUpdate extends FormRequest
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
     * @return array<string, mixed>
     */

    // validation rules
    public function rules()
    {
        return [
            'old_password' => ['required'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->symbols()
                    ->numbers()
                    ->mixedCase()
            ],
            'password_confirmation' => ['required'] 
        ];
    }

    // custom validation messages
    public function messages()
    {
        return [
            'old_password.required' => 'Please Enter Your Old Password',
            'password.required' => 'Enter a New Password',
            'password_confirmation.required' => 'Please Re-Enter Your New Password',
        ];
    }
}
