<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class TimetableRequest extends FormRequest
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
            'title' => 'required|string|max:200',
            'start' => 'nullable|date_format:"H:i"',
            'end' => 'nullable|required_with:start|date_format:"H:i"',
            'color' => ['required', 'regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i'],
            'description' => 'nullable|string|max:200'
        ];
    }

    public function attributes()
    {
        return [
            'title' => __('Title'),
            'start' => __('Start'),
            'end' => __('End'),
            'color' => __('Color'),
            'description' => __('Description')
        ];
    }
}
