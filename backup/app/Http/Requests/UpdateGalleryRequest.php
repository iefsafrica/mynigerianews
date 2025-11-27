<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGalleryRequest extends FormRequest
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
            'title' => 'required|max:160|unique:galleries,title,'.$this->route('gallery_image'),
            'images.*' => 'required|mimes:jpeg,png,jpg,webp,svg',
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
            'images.*.mimes' => __('messages.placeholder.the_images_must_be_a_file_of_type'),
        ];
    }
}
