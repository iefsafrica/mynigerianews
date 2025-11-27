<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email,'.$this->route('doctor.user')->id,
            'dob' => 'nullable|date',
            'contact' => 'required',
            'experience' => 'nullable|numeric',
            'specializations' => 'required',
            'gender' => 'required',
            'status' => 'nullable',
        ];
    }
}
