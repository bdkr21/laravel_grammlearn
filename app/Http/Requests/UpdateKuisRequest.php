<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKuisRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna diizinkan untuk membuat permintaan ini.
     */
    public function authorize()
    {
        return true; // Set true agar request bisa digunakan
    }

    /**
     * Aturan validasi untuk permintaan ini.
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'topic' => 'required|string|max:500',
        ];
    }
}
