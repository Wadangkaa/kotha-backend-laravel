<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFacilityRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'bed_room' => ['required', 'numeric'],
            'kitchen' => ['required', 'boolean'],
            'bathroom' => ['required', 'numeric'],
            'parking' => ['required', 'boolean'],
            'balcony' => ['required', 'boolean'],
            'rental_floor' => ['required', 'exists:rental_floors,id'],
            'water_facility' => ['required', 'boolean'],
        ];
    }
}
