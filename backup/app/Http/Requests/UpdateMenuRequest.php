<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuRequest extends FormRequest
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
            'title' => 'required|max:190|unique:menus,title,'.$this->route('menu')->id,
            'link' => 'required|url',
            'order' => 'nullable|numeric|min:1',
            //            'show_in_menu' => 'required',
        ];
    }
}
