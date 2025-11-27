<?php

namespace App\Http\Requests;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;

class CreateLanguageRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return Language::$rules;
    }

    public function messages(): array
    {
        $messages['iso_code.required'] = __('messages.placeholder.the_iso_code_field_is_required');

        return $messages;
    }
}
