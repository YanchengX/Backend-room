<?php

namespace App\Http\Requests\Message;

use Illuminate\Foundation\Http\FormRequest;

class PostTextRequest extends FormRequest
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
            'user_id' => ['required'],
            'content' => ['required'],
        ];
    }
    
    public function messages(): array
    {
        return[
            'user_id' => __('validation.required'),
            'content' => __('validation.required'),
        ];
    }
}
