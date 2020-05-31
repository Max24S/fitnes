<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|min:4|max:20',
            'surname' => 'required|min:4|max:20',
            'patronymic' => 'required|min:4|max:20',
            'email' => 'required|email|unique:users',
            'number' => 'required|max:13',
            'address' => 'required|max:255',
            'sex' => 'required',
            'role' => 'required|not_in:none',
            'password' =>"required|max:20"
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
