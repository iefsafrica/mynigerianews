<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CreateStaffRequest extends FormRequest
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
            'email' => 'required|max:160|email:filter|unique:users,email',
            'username' => 'required|max:50|unique:users,username',
            'contact' => 'required|numeric|digits:10',
            'password' => 'required|same:password_confirmation|min:6|max:190',
            'gender' => 'required',
            'role' => 'required',
            'about_us' => 'max:250',
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
