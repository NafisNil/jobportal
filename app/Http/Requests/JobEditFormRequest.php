<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobEditFormRequest extends FormRequest
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
            //
            'title' => 'required|min:5',
            'feature_image' => 'mimes:jpg,png,jpeg,svg,webp|max:2048',
            'description' => 'required',
            'roles' => 'required',
            'job_types' => 'required',
            'address' => 'required',
            'date' => 'required',
            'salary' => 'required'
        ];
    }
}
