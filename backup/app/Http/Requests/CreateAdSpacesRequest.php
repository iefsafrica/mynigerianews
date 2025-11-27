<?php

namespace App\Http\Requests;

use App\Models\AdSpaces;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CreateAdSpacesRequest extends FormRequest
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
    public function rules(Request $request): array
    {
        $adSpace = $request->ad_space;
        $rules = [];

        if(in_array($adSpace,[12,13,14,15,16,17])){

            $rules['ad_banner.0'] = 'dimensions:width=407,height=340';

            if ($request['ad_space'] == AdSpaces::ALL_DETAILS_SIDE_THEME_1) {
                return $rules;
            }

            $rules['ad_banner.1'] = 'dimensions:width=407,height=340';
            $rules['ad_banner.0'] = 'dimensions:width=1280,height=150';

        }else{
            $rules['ad_banner.0'] = 'dimensions:width=350,height=290';

            if ($request['ad_space'] == AdSpaces::ALL_DETAILS_SIDE) {
                return $rules;
            }

            $rules['ad_banner.1'] = 'dimensions:width=350,height=290';
            $rules['ad_banner.0'] = 'dimensions:width=800,height=130';
        }

        return $rules;
    }


    public function messages(): array
    {
        $adSpace = request()->ad_space;
        $messages = [];

        if(in_array($adSpace,[12,13,14,15,16,17])){

            $messages['ad_banner.0.dimensions'] = __('messages.ad_space.mobile_view_image_dimensions_must_be_407X340');

            if ($adSpace == AdSpaces::ALL_DETAILS_SIDE_THEME_1) {
                return $messages;
            }

            $messages['ad_banner.1.dimensions'] = __('messages.ad_space.mobile_view_image_dimensions_must_be_407X340');
            $messages['ad_banner.0.dimensions'] = __('messages.ad_space.desktop_view_image_dimensions_must_be_1280X150');
        }else{

            $messages['ad_banner.0.dimensions'] = __('messages.placeholder.mobile_view_image_dimensions_must_be_350X290');

            if ($adSpace == AdSpaces::ALL_DETAILS_SIDE) {
                return $messages;
            }

            $messages['ad_banner.1.dimensions'] = __('messages.placeholder.mobile_view_image_dimensions_must_be_350X290');
            $messages['ad_banner.0.dimensions'] = __('messages.placeholder.desktop_view_image_dimensions_must_be_800X130');
        }

        return $messages;
    }
}
