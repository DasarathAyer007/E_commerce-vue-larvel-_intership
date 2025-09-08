<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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
            'orderItems' => 'required|array|min:1',
            'orderItems.*.product_id' => 'required|integer|exists:products,id',
            'orderItems.*.quantity' => 'required|integer|min:1',
            'shippingInfo' => 'required|array',
            'shippingInfo.phone' => 'required|string|max:20',
            'shippingInfo.address' => 'required|string|max:255',
            'shippingInfo.city' => 'required|string|max:100',
            'shippingInfo.postal_code' => 'required|string|max:20',
        ];
    }
}
