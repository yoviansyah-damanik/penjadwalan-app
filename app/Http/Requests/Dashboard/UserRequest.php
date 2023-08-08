<?php

namespace App\Http\Requests\Dashboard;

use App\Models\Officer;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            're_password' => 'required|same:password',
            'officer' => [
                'nullable',
                Rule::in(Officer::doesntHave('user')->pluck('slug')->toArray())
            ]
        ];
    }

    public function attributes(): array
    {
        return [
            'username' => __('Username'),
            'email' => __('Email'),
            'password' => __('Password'),
            're_password' => __('Re-Password'),
            'officer' => __('Officer'),
        ];
    }
}
