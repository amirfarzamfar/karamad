<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResumeRequest extends FormRequest
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
            'gender' => 'required|string',
            'marital_status'=>'required|string',
            'year_of_birth'=>'required|date',
            'military_exemption'=>'required',
            'email'=>'required|email',
            'phone_number'=>['required','string','regex:/^(\+98|0)?9\d{9}$/'],
            'image'=>['nullable','image','mimes:jpeg,png,jpg,gif'],
            'city'=>'required|string',
            'Province'=>'required|string',
            'address'=>'required|string',
            'about_me'=>'nullable|string',
            'workexperince.*.job_title'=>'required|string',
            'workexperince.*.organization_name'=>'required|string',
            'workexperince.*.start_of_work'=>'required|date',
            'workexperince.*.end_of_work'=>'nullable|date',
            'workexperince.*.currently_employed'=>'nullable|accepted',//-------------------
            'skill.*.skill_name'=>'required|string',
            'skill.*.skill_percentage'=>'required|integer',
            'EducationalRecord.*.grade'=>'required|string',
            'EducationalRecord.*.field_of_study'=>'required|string',
            'EducationalRecord.*.university_name'=>'required|string',
            'EducationalRecord.*.currently_studying'=>'nullable|accepted',//---------------
            'EducationalRecord.*.entering_year'=>'required|date',
            'EducationalRecord.*.graduation_year'=>'nullable|date',
            'instagram_id'=>'nullable|string',
            'github_id'=>'nullable|string',
            'linkedin_id'=>'nullable|string',
            'personalResume.*.name'=>['nullable','file','mimes:pdf'],
        ];
    }
}
