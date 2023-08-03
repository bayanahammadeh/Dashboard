<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePesonalRequest extends FormRequest
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
            'email' => [
                'required',
                'unique:personals,email',
                Rule::unique('personals', 'email')->ignore($this->id)
            ],
            'fname' => 'required',
            'lname' => 'required',
            'title' => 'required',
            'description' => 'required',
            'mobile' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'file' =>  'required|mimes:pdf'
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Email Must Be unique',
            'email.email' => 'Check the E-mail Format',
            'email.required' => 'Email  Field is required',
            'fname.required' => 'First Name  Field is required',
            'lname.required' => 'Last Name  Field is required',
            'title.required' => 'Title  Field is required',
            'description.required' => 'Description  Field is required',
            'mobile.required' => 'Mobile  Field is required',
            'phone.required' => 'Phone  Field is required',
            'address.required' => 'Address  Field is required',
            'file.required' => 'CV  Field is required',
            'file.mimes' => 'CV Must Be pdf format',
        ];
    }
}
