<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;

class RoomCreateRequest extends FormRequest
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
            'name' => ['required'],
            'key' => ['required'],
            'owner' => ['required'],
        ];
    }
    
    public function messages(): array
    {
        return[
            'name' => __('validation.required'),
            'key' => __('validation.required'),
            'owner' => __('validation.required'),
        ];
    }
}
