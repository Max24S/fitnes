<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        $rules = [
            'name' => 'required|max:20',
            'surname' => 'required|max:20',
            'patronymic' => 'required|max:20',
            'email' => ['required','email', 'max:255', 'unique:users,email,'.$this['id']],
            'number' => 'required|max:13',
            'address' => 'required|max:255',
            'sex' => 'required',
            'role' => 'required',
            'password' =>"nullable|max:20"
        ];

        return $rules;
    }
    public function attributes()
    {
        return [
            'email' => 'email',
        ];
    }
    public function messages()
    {
        return [
            'email.unique'  => 'Користувач з таким: attribute є',
        ];
    }
}
