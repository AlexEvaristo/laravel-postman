<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/** @package App\Http\Requests */
class CadastroProdutoRequest extends FormRequest
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
    public function rules($id)
    {
        return [
            'name'        => "required|min:3|max:100|unique:products",
            'description' => 'required|min:3|max:1500'
        ];
    }

    public function prepareforvalidation() {
        //
    }
}
