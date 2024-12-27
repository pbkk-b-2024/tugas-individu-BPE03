<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrderRequest extends FormRequest
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
        $itemId = $this->route('order')->id;

        return [
            'users_id' => 'required|exists:users,id',
            'item_id' => 'required|exists:item,id',
            'quantity' => 'required|integer',
            'total' => 'required|integer',
            'status' => 'required|string',
        ];
    }
}
