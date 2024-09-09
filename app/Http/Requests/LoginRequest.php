<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'string'],
        ];
    }

    public function authorize(): true
    {
        return true;
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if (! auth()->attempt($this->safe(['email', 'password']))) {
                    $validator->errors()->add('password', 'These credentials do not match our records.');
                }
            },
        ];
    }
}
