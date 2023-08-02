<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
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
}
