<?php

namespace App\Http\Requests\Link;

use App\Http\Requests\BaseRequest;
use App\Rules\FetchLinkRule;

class FetchRequest extends BaseRequest
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
            'link_id' => [
                'required',
//                new FetchLinkRule(),
            ],
        ];
    }

    public function all($keys = null): array
    {
        return array_replace_recursive(parent::all($keys), $this->route()->parameters());
    }
}
