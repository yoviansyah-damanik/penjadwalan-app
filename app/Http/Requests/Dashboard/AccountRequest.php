<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
            'username' => 'required|unique:users,username,' . Auth::id(),
            'email' => 'required|unique:users,email,' . Auth::id(),
            'name' => 'required|max:200'
        ];
    }

    public function attributes(): array
    {
        return [
            'username' => __('Username'),
            'email' => __('Email'),
            'name' => __('Full Name')
        ];
    }
}
