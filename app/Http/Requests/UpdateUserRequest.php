<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'points' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus diisi',
            'username.required' => 'Username harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email harus valid',
            'points.required' => 'Point harus diisi',
            'points.numeric' => 'Point harus berupa angka',
        ];
    }
}
