<?php

namespace App\Http\Requests;

use App\Models\City;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class CityCreateRequest extends FormRequest
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
            'slug'          => [ 'required', 'min:2', 'max:64', $this->slugUniqueRule() ],
            'city_name'     => [ 'required', 'min:2', 'max:64', $this->nameUniqueRule() ],
            'email'         => 'required | string | email',
            'phone'         => 'required | number | min:10 | max|10',
            'w_id'          => 'required',
            'restaurant_id' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'slug'          => 'Домен',
            'city_name'     => 'Город',
            'email'         => 'Email',
            'phone'         => 'Телефон',
            'w_id'          => 'Идентификатор предприятия (Мобидел)',
            'restaurant_id' => 'UID службы доставки (Мобидел)',
        ];
    }

    protected function slugUniqueRule(): Unique
    {
        return Rule::unique(City::class, 'slug');
    }

    protected function nameUniqueRule(): Unique
    {
        return Rule::unique(City::class, 'city_name');
    }
}
