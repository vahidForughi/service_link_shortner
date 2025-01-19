<?php

namespace App\DTO;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BaseDTO
{
    public function __construct()
    {
        $this->validate();
    }

    public function toArray()
    {
//        return collect(get_object_vars($this))->mapWithKeys(fn ($item, $key) => [Str::snake($key), $item])->all();
        $array = [];

        foreach (get_object_vars($this) as $key => $value) {
            $array[Str::snake($key)] = $value;
        }

        return $array;
    }

    protected function rules(): array
    {
        return [
            //
        ];
    }

    protected function validate()
    {
        $validator = Validator::make(get_object_vars($this), $this->rules());

        if ($validator->fails()) {
            throw new \InvalidArgumentException();
        }
    }
}
