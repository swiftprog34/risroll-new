<?php

namespace App\Http\Requests\City;

use Illuminate\Validation\Rules\Unique;

class CityUpdateRequest extends CityCreateRequest
{
    protected function slugUniqueRule(): Unique
    {
        return parent::slugUniqueRule()->ignore($this->city->id);
    }

    protected function nameUniqueRule(): Unique
    {
        return parent::nameUniqueRule()->ignore($this->city->id);
    }
}
