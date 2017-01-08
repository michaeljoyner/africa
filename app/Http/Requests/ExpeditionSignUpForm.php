<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpeditionSignUpForm extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required|max:50'
        ];
    }

    public function requiredFields()
    {
        return collect($this->only(['name', 'email', 'phone', 'enquiry']))
            ->flatMap(function($value, $field) {
                return [$field => $value === '' ? null : $value];
            })->toArray();
    }
}
