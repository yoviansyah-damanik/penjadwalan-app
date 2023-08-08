<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class AccountNewPasswordRequest extends FormRequest
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
            'password' => 'required_with:new_password|current_password',
            'new_password' => 'required|min:8',
            're_password' => 'required|same:new_password',
        ];
    }

    public function attributes(): array
    {
        return [
            'password' => __('Current Password'),
            'new_password' => __('New Password'),
            're_password' => __('Re-Password'),
        ];
    }
}
