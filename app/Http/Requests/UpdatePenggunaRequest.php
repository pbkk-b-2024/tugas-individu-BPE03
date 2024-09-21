<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePenggunaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        // Return true if all users are allowed to make this request.
        // You can add additional authorization logic here.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        // Get the current Item instance from the route
        $penggunaId = $this->route('pengguna')->id;

        return [
            'nama' => 'required|string|max:255',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'kategori' => 'required|array',
            'kategori.*' => 'exists:kategori,id',
            'deskripsi' => 'nullable|string',
        ];
    }
}
