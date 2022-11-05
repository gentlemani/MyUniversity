<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Validation\Validator;

class StudentRegistrationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'degree' => 'required|exists:coordinators,degree',
            'semester' => 'required|numeric|max:16',
            'email' => ['required', 'regex:/(\W|^)[\w.\-]{0,25}@(alumnos)\.udg\.mx(\W|$)/i', 'unique:users'],
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ];
    }
    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->isNotEmpty()) {
                $validator->errors()->add('students', 'Errors!');
            }
        });
    }
}
