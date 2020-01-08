<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Feadback extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'not' => 'required|integer',
            'commant' => 'required|min:10|max:10000',
            'title' => 'required|string|max:255',
            'exp_date_start' => 'date|nullable',
            'exp_date_fin' => 'date|nullable',
            'comand_num' => 'string|min:4|max:10|nullable',
            'is_private' => 'required|boolean',
        ];
    }
}
