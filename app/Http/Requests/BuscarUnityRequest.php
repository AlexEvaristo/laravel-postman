<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/** @package App\Http\Requests */
class BuscarUnityRequest extends FormRequest
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
    public function rulesSearch(): array
    {
        return [
            'key-search' => array('required')
        ];
    }

    public function prepareforvalidation() {
        //
    }
}
