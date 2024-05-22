<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
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
            'u_name' => 'required|',
            'u_hour' => 'required|integer',
            'u_provider' => 'required|',
            'u_certificate' => 'file|mimes:png,jpg,jpeg,pdf,ppt',
        ];
    }

    public function attributes(): array
    {
        return [
            'u_name' => 'course',
            'u_hour' => 'hour',
            'u_provider' => 'provider',
            'u_certificate' => 'certificate',
        ];
    }
}
