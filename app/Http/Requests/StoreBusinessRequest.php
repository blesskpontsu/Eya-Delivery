<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBusinessRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:100', 'required', 'unique:businesses'],
            'category' => ['required', 'string', 'max:100'],
            'location' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:15', 'unique:businesses']
        ];
    }
}
