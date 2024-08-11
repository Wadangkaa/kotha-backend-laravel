<?php

namespace App\Http\Requests;

use App\Enums\KothaPurposeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreKothaRequest extends FormRequest
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
            'title' => ['required'],
            'description' => ['nullable'],
            'category_id' => ['numeric', 'exists:categories,id'],
            'price' => ['numeric'],
            'negotiable' => ['boolean'],
            'purpose' => new Enum(KothaPurposeEnum::class),
        ];
    }
}
