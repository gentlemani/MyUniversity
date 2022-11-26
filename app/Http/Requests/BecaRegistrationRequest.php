<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BecaRegistrationRequest extends FormRequest
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
            'description' => 'required|string|max:255',
            'endDate' => 'required|after:today',
            'amount' => 'required|numeric|min:1',
            'capacity' => 'required|numeric|min:1',
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
                $validator->errors()->add('becas', 'Errors!');
            }
        });
    }
}
