<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoriesRequest extends FormRequest
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
            'slug' => 'required|unique:categories,slug,'.$this->route('category')->id,
            'name' => 'required|max:190',
            'lang_id' => 'required',
            'category_image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ];
    }
}
