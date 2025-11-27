<?php

namespace App\Http\Requests;

use App\Models\Post;
use App\Models\PostArticle;
use App\Models\PostAudio;
use App\Models\PostGallery;
use App\Models\PostSortList;
use App\Models\PostVideo;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
        $rules = Post::$rules + PostArticle::$rules + PostGallery::$rules + PostSortList::$rules + PostVideo::$rules + PostAudio::$rules;
        $rules['slug'] = 'required|unique:posts,slug,'.request()->get('id');
        $rules['image'] = 'nullable|mimes:jpeg,png,jpg,webp,svg';

        return $rules;
    }

    public function messages(): array
    {
        return [

            'gallery_title.*.max' => __('messages.placeholder.gallery_title_must_not_be_greater_than_190_characters'),
            'sort_list_title.*.max' => __('messages.placeholder.sort_list_title_must_not_be_greater_than_190_characters'),
            'additional_images.*.dimensions' => __('messages.post.additional_image_dimensions_must_be_310X290'),
        ];
    }
}
