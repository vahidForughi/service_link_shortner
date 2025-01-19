<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    public function validated(
        $key = null,
        $default = null,
    ): array
    {
        return $this->serializeNullables(
            validatedData: parent::validated(
                key: $key,
                default: $default,
            ),
        );
    }

    protected function serializeNullables(
        array $validatedData,
        array $rules = null,
    ): array
    {
        $nullables = [];

        foreach (!empty($rules) ? $rules : $this->rules() as $attr => $rules) {
            if (
                !str_contains(
                    haystack: $attr,
                    needle: '.',
                )
                && !in_array(
                    needle: 'array',
                    haystack: $rules,
                )
                && in_array(
                    needle: 'nullable',
                    haystack: $rules,
                )
                && !in_array(
                    needle: $attr,
                    haystack: $nullables,
                )
            ) {
                $nullables[] = $attr;
            }
        }

        foreach ($nullables as $nullable) {
            if (
                in_array(
                    needle: $nullable,
                    haystack: array_keys($validatedData),
                )
            ) {
                if ($validatedData[$nullable] == '') {
                    $validatedData[$nullable] = null;
                }
            } else {
                $validatedData[$nullable] = null;
            }
        }

        return $validatedData;
    }
}
