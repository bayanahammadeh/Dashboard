<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'email' => 'unique:users,email,'.$this->id,
            'name' => 'required',
            'password' => 'required|min:8',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Email Must Be unique',
            'email.email' => 'Check the E-mail Format',
            'email.required' => 'Email  Field is required',
            'name.required' => 'Name  Field is required',
            'password.required' => 'Password  Field is required',
            'password.min' => 'Password Field must be the length should be 8',
        ];
    }
}
