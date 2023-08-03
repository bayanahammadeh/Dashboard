<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkillRequest extends FormRequest
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
            'name' => 'required',
            'percentage' => 'required',
            'personal' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name  Field is required',
            'percentage.required' => 'Percentage  Field is required',
            'personal.required' => 'Personal  Field is required',
        ];
    }
}
