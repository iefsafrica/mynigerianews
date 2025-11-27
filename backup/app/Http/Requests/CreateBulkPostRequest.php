<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBulkPostRequest extends FormRequest
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
            'bulk_post' => 'required',
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
            'bulk_post.required' => __('messages.placeholder.the_upload_csv_file_field_is_required'),
        ];
    }
}
