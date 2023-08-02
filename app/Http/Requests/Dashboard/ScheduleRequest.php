<?php

namespace App\Http\Requests\Dashboard;

use App\Models\Area;
use App\Models\Officer;
use App\Models\Timetable;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
            'officer' => [
                'required',
                Rule::in(Officer::active()->get()->pluck('id')->toArray())
            ],
            'area' => [
                'required',
                Rule::in(Area::get()->pluck('id')->toArray())
            ],
            'timetable' => [
                'required',
                Rule::in(Timetable::get()->pluck('id')->toArray())
            ],
            'date' => 'required',
            'description' => 'nullable|string|max:200',
        ];
    }

    public function attributes(): array
    {
        return [
            'officer' => __('Officer Name'),
            'area' => __('Area'),
            'timetable' => __('Timetable'),
            'date' => __('Date'),
            'description' => __('Description')
        ];
    }
}
