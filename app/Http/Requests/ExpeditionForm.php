<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpeditionForm extends FormRequest
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
        return [
            'name'       => 'required|max:255',
            'location'   => 'max:255',
            'duration'   => 'max:255',
            'start_date' => 'max:255',
            'end_date' => 'max:255',
            'capacity'   => 'max:255',
            'difficulty' => 'max:255',
        ];
    }

    public function acceptedFields()
    {
        return collect($this->only([
            'name',
            'description',
            'writeup',
            'location',
            'duration',
            'start_date',
            'end_date',
            'capacity',
            'places_remaining',
            'difficulty'
        ]))->flatMap(function ($value, $field) {
            return [$field => $value !== '' ? $value : null];
        })->toArray();
    }
}
