<?php

namespace App\Http\Requests\GoodsReceiving;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class GoodsReceivingCreateRequest extends FormRequest
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
            'delivery_zone_id' => 'required|integer|exists:delivery_zones,id',
            'receiving_variant' => 'required|integer',
        ];
    }

    public function attributes()
    {
        return [
            'delivery_zone_id'                       => 'Зона доставки',
            'receiving_variant'          => 'Вариант получения',
        ];
    }
}
