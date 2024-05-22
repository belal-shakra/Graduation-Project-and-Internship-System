<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateInternshipCompanyRequest extends FormRequest
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
            'company_name' => '|required',
            'address' => '|required',

            'starting_date' => '|required|date',
            'ending_date' => '|required|date|',

            'supervisor_name' => '|required',
            'supervisor_email' => '|required|email',

            'description' => '|required|max:255',
            'technologies' => '|required|max:255',
        ];
    }


    public function  attributes(){
        return [
            'company_name' => 'company name',
            'starting_date' => 'starting date',
            'ending_date' => 'ending date',
            'supervisor_name' => 'supervisor name',
            'supervisor_email' => 'supervisor email',
        ];
    }
}
