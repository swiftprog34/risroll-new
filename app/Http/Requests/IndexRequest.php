<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
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
            'value' => 'required|string|min:6|max:6',
            'delivery_zone_id' => 'required|integer|exists:delivery_zones,id',
        ];
    }

    public function attributes()
    {
        return [
            'value'          => 'Индекс',
            'delivery_zone_id'          => 'Зона доставки',
        ];
    }
}
