<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserProfileRequest extends FormRequest
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
        $id = Auth::id();

        return [
            'first_name' => 'required|max:190',
            'last_name' => 'required|max:190',
            'email' => 'required|email:filter|max:160|unique:users,email,'.$id.'|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i',
            'username' => 'required|max:50|unique:users,username,'.$id,
            'contact' => 'required|numeric|digits:10',
            'image' => 'mimes:jpeg,jpg,png',
            'about_us' => 'max:250',
        ];
    }
}
