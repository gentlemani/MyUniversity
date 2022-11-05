<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
    // Posteriormente será todo completo así 'regex:/(\W|^)[\w.\-]{0,25}@(alumnos|docentes|coordinadores)\.udg\.mx(\W|$)/i'
    // Pero de momento solo está disponible para coordinadores
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => ['required', 'regex:/(\W|^)[\w.\-]{0,25}@(coordinadores)\.udg\.mx(\W|$)/i', 'unique:users'],
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            'degree' => 'required',
            'gender' => 'required',
        ];
    }
}
