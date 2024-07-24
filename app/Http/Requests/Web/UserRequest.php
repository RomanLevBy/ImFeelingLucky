<?php

namespace App\Http\Requests\Web;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:80'],
            'phone' => ['required', 'numeric'],
        ];
    }
}
