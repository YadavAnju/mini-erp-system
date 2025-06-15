<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        $productId = $this->route('product')->id;
        return [
            'name'     => 'required|string|max:100',
            'sku'      => 'required|string|max:50|unique:products,sku,' . $productId,
            'price'    => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ];
    }
}
