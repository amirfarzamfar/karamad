<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class test extends FormRequest
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
            'EducationalRecord.*.grade'=>'required|string',
            'EducationalRecord.*.field_of_study'=>'nullable',
            'EducationalRecord.*.university_name'=>'nullable',
            'EducationalRecord.*.entering_year'=>'nullable',
            'EducationalRecord.*.graduation_year'=>'nullable',
            'EducationalRecord.*.currently_studying'=>'nullable',
            'skill.*.skill_name'=>'required|string',
            'skill.*.skill_percentage',
        ];
    }
}
