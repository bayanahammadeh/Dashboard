<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'project_name' => 'required',
            'project_url' => 'required',
            'file' =>'required|mimes:jpg,png,jpeg',
            'personal' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'project_name.required' => 'Project Name  Field is required',
            'project_url.required' => 'URL  Field is required',
            'file.required' => 'Image  Field is required',
            'file.mimes' => 'Image Must Be one of these format (jpeg,png,jpg)',
        ];
    }
}
