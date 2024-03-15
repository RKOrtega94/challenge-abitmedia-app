<?php

namespace App\Http\Requests;

use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class LicenseRequest extends FormRequest
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
        $method = $this->method();

        if ($method === "POST") {
            return [
                "product_id" => "required|exists:products,id",
                "platform" => "required|in:windows,mac",
            ];
        } else if ($method === "PUT") {
            return [
                "status" => "required|in:active,sold,inactive",
            ];
        } else {
            throw new Exception("Invalid method");
        }
    }
}
