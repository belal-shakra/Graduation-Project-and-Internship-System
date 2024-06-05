<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDashboardRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'start'          => 'required|date|nullable',
            'end'            => 'required|date|nullable',
            'no_team_member' => 'required|numeric',
            'week'           => 'required|numeric|min:1|max:7',
        ];
    }


    public function attributes()
    {
        return [
            'start'          => 'starting date',
            'end'            => 'ending date',
            'no_team_member' => 'number of team\'s member',
            'week'           => 'internship week',
        ];
    }
}
