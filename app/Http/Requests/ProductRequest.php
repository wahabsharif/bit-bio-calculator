<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        $this->merge([
            'sku' => $this->sku !== '' ? $this->sku : null,
            'seeding_density' => $this->seeding_density !== '' ? $this->seeding_density : null,
        ]);
    }

    public function rules()
    {
        $productId = $this->route('product') ? $this->route('product')->id : null;

        return [
            'product_name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:50|unique:products,sku,' . $productId,
            'seeding_density' => 'nullable|numeric|min:0',
        ];
    }
}
