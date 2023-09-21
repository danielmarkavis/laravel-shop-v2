<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductShowRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'colour'          => 'string|max:255', // Use this to filter colour variants and provide sizes.
            'sku'             => 'string|max:255' //Should
        ];
    }

}
