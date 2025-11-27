<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStaffRequest extends FormRequest
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
        return [
            'first_name' => 'required|max:190',
            'last_name' => 'required|max:190',
            'email' => 'required|email:filter|max:160|unique:users,email,'.$this->route('staff')->id,
            'contact' => 'required|numeric|digits:10',
            'password' => 'nullable|same:password_confirmation|min:6',
            'gender' => 'required',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'contact.required' => __('messages.placeholder.contact_number_field_is_required'),
        ];
    }
}
