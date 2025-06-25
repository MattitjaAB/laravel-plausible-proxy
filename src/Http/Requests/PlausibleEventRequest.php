<?php

namespace MattitjaAB\LaravelPlausibleProxy\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlausibleEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'n' => ['required', 'string'],
            'u' => ['required', 'url'],
            'd' => ['required', 'string'],
            'r' => ['nullable', 'url'],
            'm' => ['nullable', 'string'],
            'p' => ['nullable', 'array'],
        ];
    }
}
