<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'kategori' => 'required|array',
            'kategori.*' => 'exists:kategori,id',
            'deskripsi' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'users_id' => 'required|integer',
        ];
    }
}
