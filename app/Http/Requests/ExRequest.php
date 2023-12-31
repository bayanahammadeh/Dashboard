<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'header' => 'required',
            'description' => 'required',
            'experience' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'header.required' => 'Header Field is required',
            'description.required' => 'Detail Field is required',
        ];
    }
}
