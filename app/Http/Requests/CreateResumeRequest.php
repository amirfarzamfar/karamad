<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateResumeRequest extends FormRequest
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
            'name'=>'required|string',
            'family'=>'required|string',
            'year_of_birth'=>'required|date',
            'military_exemption'=>'required',
            'email'=>'required|email',
            'phone_number'=>'required|regex:/^(\+98|0)?9\d{9}$/',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif',
            'city'=>'nullable|string',
            'address'=>'required|string',
            'about_me'=>'nullable|string',
            'job_title'=>'required|string',
            'organization_name'=>'required|string',
            'start_of_work'=>'required|date',
            'end_of_work'=>'nullable|date',
            'currently_employed'=>'required|string',
            'skill_name'=>'required|string',
            'skill_percentage'=>'required|integer',
            'grade'=>'required|string',
            'field_of_study'=>'required|string',
            'university_name'=>'required|string',
            'email_id'=>'nullable|email',
            'github_id'=>'nullable|string',
            'linkedin_id'=>'nullable|string',
            'entering_year'=>'required|date',
            'graduation_year'=>'required|date',
        ];
    }
}
