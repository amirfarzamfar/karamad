<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class   CreateAdRequest extends FormRequest
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
            'title'=>'required|string',
            'gender'=>'required|string',
            'type_of_cooperation'=>'required|string',
            'military_exemption'=>'required|string',
            'salary'=>'required|string',
            'city_id'=>'required|integer',
            'Province_id'=>'required|integer',
            'degree_of_education'=>'required|string',
            'address'=>'required|string',
            'about'=>'nullable|string',
            'skill.*.skill_name'=>'required|string',
            'skill.*.skill_percentage'=>'required|integer',
            'Advantages'=>'required|string',
            'job_category_id'=>'required|integer'
        ];
    }
}
