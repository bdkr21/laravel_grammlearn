<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMateriRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Ganti jika perlu otorisasi khusus
    }

    /**
     * Define validation rules.
     */
    public function rules(): array
    {
        return [

            // 'slug' => 'required|string|unique:courses,slug,' . $this->route('materi')->id,
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ];
    }

    /**
     * Custom error messages (optional).
     */
    public function messages(): array
    {
        return [
            'slug.required' => 'Slug wajib diisi.',
            'slug.unique' => 'Slug sudah digunakan, silakan gunakan slug lain.',
            'title.required' => 'Judul wajib diisi.',
            'title.max' => 'Judul tidak boleh lebih dari 255 karakter.',
            'content.required' => 'Konten wajib diisi.',
        ];
    }
}
