<?php

namespace App\Http\Requests\Dashboard;

use App\Models\Officer;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class OfficerRequest extends FormRequest
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
            'name' => 'required|string|max:200',
            'address' => 'required|string|max:200',
            'status' => [
                'required',
                Rule::in(Officer::STATUS)
            ]
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('Officer Name'),
            'address' => __('Address'),
            'status' => __('Status')
        ];
    }
}
