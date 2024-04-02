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
            'workexperince.*.job_title'=>'required|string',
            'workexperince.*.organization_name'=>'required|string',
            'workexperince.*.start_of_work'=>'required|date',
            'workexperince.*.end_of_work'=>'nullable|date',
            /*'workexperince.*.currently_employed'=>'accepted',*/
            'skill.*.skill_name'=>'required|string',
            'skill.*.skill_percentage'=>'required|integer',
            'EducationalRecord.*.grade'=>'required|string',
            'EducationalRecord.*.field_of_study'=>'required|string',
            'EducationalRecord.*.university_name'=>'required|string',
            'instagram_id'=>'nullable|email',
            'github_id'=>'nullable|string',
            'linkedin_id'=>'nullable|string',
            'EducationalRecord.*.entering_year'=>'required|date',
            'EducationalRecord.*.graduation_year'=>'required|date',
            /*'EducationalRecord.*.currently_studying'=>'accepted',*/
            'personalResume.*.name'=>'nullable|file|mimes:pdf',
        ];
    }
}
