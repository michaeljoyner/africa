<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssocciatesForm extends FormRequest
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
        $social = collect(config('social.platforms'))->flatMap(function($platform) {
            return $platform === 'email' ?  [$platform => 'email'] : [$platform => 'url'];
        })->toArray();
        return array_merge([
            'name' => 'required|max:255',
        ], $social);
    }

    public function acceptedFields()
    {
        return collect($this->only('name', 'writeup'))->flatMap(function ($value, $field) {
            return [$field => $value === '' ? null : $value];
        })->toArray();
    }

    public function socialLinks()
    {
        return collect($this->only(config('social.platforms')))
            ->reject(function ($url) {
                return $url === '' || is_null($url);
            })->toArray();
    }
}
