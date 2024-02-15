<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'is_new_item' => ['required', 'integer'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'string'],
            'is_active' => ['required', 'integer'],
        ];
    }

    public function attributes()
    {
        return [
            'is_new_item'       => 'Новинка',
            'title'             => 'Заголовок',
            'description'       => 'Описание',
            'price'             => 'Цена',
            'is_active'         => 'Товар доступен на сайте'
        ];
    }
}
