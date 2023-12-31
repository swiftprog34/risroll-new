<?php

namespace App\Http\Requests\DeliveryZone;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryZoneRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'city_id' => 'required|integer|exists:cities,id',
            'min_delivery_price' => 'numeric|min:0'
        ];
    }

    public function attributes()
    {
        return [
            'name'          => 'Наименование зоны доставки',
            'city_id'          => 'Город',
            'min_delivery_price'          => 'Бесплатная доставка от',
        ];
    }
}
