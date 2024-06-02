<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGraduationProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'department_id' => 'required',
            'semester' => 'required|',
            'type' => 'required|',

            'supervisor_1' => 'required|string',
            'email_1' => 'required|email',

            'supervisor_2' => 'required',
            'email_2' => 'required|email',

            'name' => 'required|max:255',
            'idea' => 'required|max:255',
            'goal' => 'required|max:255',
            'technologies' => 'required|max:128',
        ];
    }


    public function attributes()
    {
        return [
            'department_id' => 'department',
            'type' => 'project type',
            'supervisor_1' => 'supervisor',
            'email_1' => 'email',
            'supervisor_2' => 'supervisor',
            'email_2' => 'email',
            'name' => 'project name',
        ];
    }
}
