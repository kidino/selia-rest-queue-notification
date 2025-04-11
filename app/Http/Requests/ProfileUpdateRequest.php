<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{

    public function prepareForValidation()
    {
        // Concatenate country_code and phone into a single phone field
        if ($this->has('country_code') && $this->has('phone')) {
            $this->merge([
                'phone' => $this->input('country_code') .' '. $this->input('phone'),
            ]);
        }
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'phone' => ['nullable', 'regex:/^\+[1-9]\d{1,4} \d{4,14}$/'], // Validate international phone number with one space
            'country_code' => ['required', 'string', 'regex:/^\+\d{1,4}$/'], // Validate country code            
        ];
    }
}
