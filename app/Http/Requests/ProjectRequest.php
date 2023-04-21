<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => 'string|required',
            'description' => 'string|required',
            'url' => 'string|nullable',
            'code' => 'string|nullable',
            'showVideo' => 'string|nullable',
            'explanationVideo' => 'string|nullable',
            'video' => 'string|nullable',
            'active' => 'boolean|required',
        ];
    }
}
