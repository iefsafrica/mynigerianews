<?php

namespace App\Repositories;

use App\Models\Setting;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;

/**
 * Class UserRepository
 */
class SettingRepository extends BaseRepository
{
    public $fieldSearchable = [
        'application_name',
    ];

    /**
     * {@inheritDoc}
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * {@inheritDoc}
     */
    public function model()
    {
        return Setting::class;
    }

    public function update($input, $userId): void
    {
        $inputArr = Arr::except($input, ['_token']);

        if ($inputArr['sectionName'] == 'general') {
            $inputArr['application_name'] = (empty($inputArr['app_name'])) ? '' : $inputArr['app_name'];
            $inputArr['contact_no'] = (empty($inputArr['contact_no'])) ? '' : $inputArr['contact_no'];
            $inputArr['email'] = (empty($inputArr['email'])) ? '' : $inputArr['email'];
        }
        if ($inputArr['sectionName'] == 'general_1') {
            $inputArr['show_captcha'] = (empty($inputArr['show_captcha'])) ? '0' : '1';
            $inputArr['show_captcha_on_registration'] = (empty($inputArr['show_captcha_on_registration'])) ? '0' : '1';
            $inputArr['site_key'] = (empty($inputArr['site_key'])) ? '' : $inputArr['site_key'];
            $inputArr['secret_key'] = (empty($inputArr['secret_key'])) ? '' : $inputArr['secret_key'];
        }
        if ($inputArr['sectionName'] == 'general_2') {
            $inputArr['whatsapp'] = (empty($inputArr['whatsapp'])) ? '0' : '1';
            $inputArr['linkedin'] = (empty($inputArr['linkedin'])) ? '0' : '1';
            $inputArr['twitter'] = (empty($inputArr['twitter'])) ? '0' : '1';
            $inputArr['facebook'] = (empty($inputArr['facebook'])) ? '0' : '1';
            $inputArr['reddit'] = (empty($inputArr['reddit'])) ? '0' : '1';
        }
        if ($inputArr['sectionName'] == 'contact_information') {
            $inputArr['contact_address'] = (empty($inputArr['contact_address'])) ? '' : $inputArr['contact_address'];
            $inputArr['about_text'] = (empty($inputArr['about_text'])) ? '' : $inputArr['about_text'];
        }
        if ($inputArr['sectionName'] == 'theme_configuration') {
            $inputArr['theme_configuration'] = (empty($inputArr['theme_id'])) ? '1' : $inputArr['theme_id'];
        }

        if ($inputArr['sectionName'] == 'cookie_warning') {
            $inputArr['cookie_warning'] = (! empty($inputArr['cookie_warning'])) ? $inputArr['cookie_warning'] :
                'Your experience on this site will be improved by allowing cookies.';
        }
        if ($inputArr['sectionName'] == 'ad_management') {
            $inputArr['header'] = (empty($inputArr['header'])) ? '0' : '1';
            $inputArr['index_top'] = (empty($inputArr['index_top'])) ? '0' : '1';
            $inputArr['index_bottom'] = (empty($inputArr['index_bottom'])) ? '0' : '1';
            $inputArr['post_details'] = (empty($inputArr['post_details'])) ? '0' : '1';
            $inputArr['details_side'] = (empty($inputArr['details_side'])) ? '0' : '1';
            $inputArr['categories'] = (empty($inputArr['categories'])) ? '0' : '1';
            $inputArr['gallery'] = (empty($inputArr['gallery'])) ? '0' : '1';
            $inputArr['trending_post'] = (empty($inputArr['trending_post'])) ? '0' : '1';
            $inputArr['popular_news'] = (empty($inputArr['popular_news'])) ? '0' : '1';
            $inputArr['trending_post_index_page'] = (empty($inputArr['trending_post_index_page'])) ? '0' : '1';
            $inputArr['popular_news_index_page'] = (empty($inputArr['popular_news_index_page'])) ? '0' : '1';
            $inputArr['recommended_post_index_page'] = (empty($inputArr['recommended_post_index_page'])) ? '0' : '1';
        }

        if ($inputArr['sectionName'] == 'generate_sitemap') {
            Artisan::call('generate:sitemap');
        }
        if ($inputArr['sectionName'] == 'advanced_setting') {
            $inputArr['emoji_system'] = (empty($inputArr['emoji_system'])) ? '0' : '1';
            $inputArr['registration_system'] = (empty($inputArr['registration_system'])) ? '0' : '1';
        }
        foreach ($inputArr as $key => $value) {

            /** @var Setting $setting */
            $setting = Setting::where('key', $key)->first();
            if (! $setting) {
                continue;
            }

            $setting->update(['value' => $value]);
            if (in_array($key, ['logo']) && ! empty($value)) {
                $setting->clearMediaCollection(Setting::LOGO);
                $media = $setting->addMedia($value)->toMediaCollection(Setting::LOGO, config('app.media_disc'));
                $setting->update(['value' => $media->getUrl()]);
            }
            if (in_array($key, ['favicon']) && ! empty($value)) {
                $setting->clearMediaCollection(Setting::FAVICON);
                $media = $setting->addMedia($value)->toMediaCollection(Setting::FAVICON, config('app.media_disc'));
                $setting->update(['value' => $media->getUrl()]);
            }
        }
    }
}
