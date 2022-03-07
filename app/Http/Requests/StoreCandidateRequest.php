<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCandidateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'position' => 'required',
            'min_salary' => 'nullable|integer',
            'max_salary' => 'nullable|integer',
            'linkedin_url' => 'nullable|string|max:255',
            'skills' => 'nullable|array',
            'cv' => 'nullable|file'
        ];
    }
}
