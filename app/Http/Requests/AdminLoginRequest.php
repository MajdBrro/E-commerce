<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends FormRequest
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
            'email' =>['required','email'],
            'password' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'you should type an email',
            'email.email' => 'this is not an email',
            'password.required' => 'you should enter a password',
        ];
    }
}
