<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
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
        if ($this->request->get('sectionName') == 'contact_information') {
            return [
                'contact_address' => 'required',
                'about_text' => 'required',
            ];
        }

        if ($this->request->get('sectionName') == 'general') {
            return [
                'email' => 'required|email:filter',
                'app_name' => 'required|max:15',
                'contact_no' => 'required',
                'copy_right_text' => 'required',
            ];
        }
        if ($this->request->get('sectionName') == 'general_1') {
            return [

            ];
        }
        if ($this->request->get('sectionName') == 'general_2') {
            return [

            ];
        }
        if ($this->request->get('sectionName') == 'social_media') {
            return [
                'facebook_url' => 'required',
                'twitter_url' => 'required',
                'instagram_url' => 'required',
                'pinterest_url' => 'required',
                'linkedin_url' => 'required',
                'vk_url' => 'required',
                'telegram_url' => 'required',
                'youtube_url' => 'required',
            ];
        }
        if ($this->request->get('sectionName') == 'cookie_warning') {
            return [
                'cookie_warning' => 'required',
            ];
        }
        if ($this->request->get('sectionName') == 'cms') {
            return [
                'terms&conditions' => 'required',
                'privacy' => 'required',
                'support' => 'required',
            ];
        }
        if ($this->request->get('sectionName') == 'ad_management') {
            return [

            ];
        }
        if ($this->request->get('sectionName') == 'generate_sitemap') {
            return [

            ];
        }
        if ($this->request->get('sectionName') == 'advanced_setting') {
            return [

            ];
        }
        if ($this->request->get('sectionName') == 'theme_configuration') {
            return [

            ];
        }
    }

    public function attributes(): array
    {
        return [
            'contact_no' => __('messages.user.contact_number'),
            'copy_right_text' => __('messages.setting.copy_right_text'),
            'terms&conditions' => __('messages.setting.terms-conditions'),
        ];
    }
}
