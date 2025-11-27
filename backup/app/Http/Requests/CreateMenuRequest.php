<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMenuRequest extends FormRequest
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
            'title' => 'required|unique:menus,title|max:190',
            'link' => 'required|url',
            'order' => 'nullable|numeric|min:1',
            //            'show_in_menu' => 'required',
        ];
    }
}
