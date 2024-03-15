<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (auth()->check()) return true;
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $productId = $this->route('product') ? $this->route('product')->id : null;

        return [
            'sku' => 'required|string|min:10|max:10|unique:products,sku,' . $productId,
            'name' => 'required|string|min:3|max:255',
            'description' => 'string|min:3|max:255',
            'windows_price' => 'required|numeric|min:0',
            'mac_price' => 'required|numeric|min:0',
        ];
    }
}
