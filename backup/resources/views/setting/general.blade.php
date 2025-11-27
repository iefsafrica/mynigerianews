
@extends('layouts.app')
@section('title')
    {{ __('messages.settings') }}
@endsection

@section('content')
    <div class="container-fluid">
        @include('setting.setting_menu')
        <div class="card">
            <div class="card-header pb-1">
                <div class="card-title m-0">
                    <h3 class="m-0">{{ __('messages.setting.general_details') }}</h3>
                </div>
            </div>
            {{ Form::open(['route' => 'setting.update', 'files' => true, 'class' => 'form']) }}
            {{ Form::hidden('sectionName', $sectionName) }}
            <div class="card-body">
                <div class="row mb-5">
                    <div class="col-lg-4">
                        {{ Form::label('app_name', __('messages.setting.app_name') . ':', ['class' => 'form-label required']) }}
                    </div>
                    <div class="col-lg-8">
                        {{ Form::text('app_name', $setting['application_name'], ['class' => 'form-control', 'placeholder' => __('messages.setting.app_name'), 'required']) }}
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-lg-4">
                        {{ Form::label('contact_no', __('messages.user.contact_number') . ':', ['class' => 'form-label required']) }}
                    </div>
                    <div class="col-lg-8">
                        {{ Form::text('contact_no', $setting['contact_no'], ['class' => 'form-control ', 'placeholder' => __('messages.user.contact_number'), 'required']) }}
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-lg-4">
                        {{ Form::label('email', __('messages.user.email') . ':', ['class' => 'form-label required']) }}
                    </div>
                    <div class="col-lg-8">
                        {{ Form::email('email', $setting['email'], ['class' => 'form-control', 'placeholder' => __('messages.user.email'), 'required']) }}
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-lg-4">
                        {{ Form::label('copy_right_text', __('messages.setting.copy_right_text') . ':', ['class' => 'form-label required ']) }}
                    </div>
                    <div class="col-lg-8">
                        {{ Form::text('copy_right_text', $setting['copy_right_text'] ?? null, ['class' => 'form-control', 'placeholder' => __('messages.setting.copy_right_text'), 'required']) }}
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-lg-4">
                        {{ Form::label('front_language', __('messages.setting.front_language') . ' :', ['class' => 'form-label required']) }}
                    </div>
                    <div class="col-lg-8">
                        {{ Form::select('front_language', getLanguage(), $setting['front_language'] ?? null, ['class' => 'form-select ', 'id' => 'selectLanguage', 'data-dropdown-parent' => '#kt_account_profile_details_form', 'placeholder' => __('messages.common.select_language'), 'data-control' => 'select2', 'required', 'aria-label' => 'Select a Language', 'data-control' => 'select2']) }}
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-lg-4">
                        {{ Form::label('rss_feed_update_time', __('messages.setting.rss_feed_auto_update') . ' :', ['class' => 'form-label required']) }}
                    </div>
                    <div class="col-lg-8">
                        {{ Form::select('rss_feed_update_time', \App\Models\Setting::AUTO_UPDATE_RSS_FEED, $setting['rss_feed_update_time'] ?? null, ['class' => 'form-select ', 'id' => 'selectRssFeed', 'data-dropdown-parent' => '#kt_account_profile_details_form', 'placeholder' => __('messages.setting.select_time'), 'data-control' => 'select2', 'required', 'aria-label' => 'Select a Rss Feed', 'data-control' => 'select2']) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <label for="exampleInputImage" class="form-label">{{ __('messages.setting.logo') }}: </label>
                        <span data-bs-toggle="tooltip" data-placement="top"
                            data-bs-original-title="{{ __('messages.placeholder.best_resolution_for_this_logo_will_be_90x60') }}">
                            <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
                        </span>
                    </div>
                    <div class="col-lg-8">
                        <div class="mb-3" io-image-input="true">
                            <div class="d-block">
                                <div class="image-picker">
                                    @php
                                        $style =
                                            'style="background-image: url(' .
                                            ($setting['logo']
                                                ? asset($setting['logo'])
                                                : asset('assets/image/infyom-logo.png')) .
                                            ')"';
                                    @endphp
                                    <div class="image previewImage" id="exampleInputImage" {!! $style !!}>
                                    </div>
                                    <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                                        data-placement="top"
                                        data-bs-original-title="{{ __('messages.common.change_logo') }}">
                                        <label>
                                            <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                            <input type="file" name="logo" class="image-upload d-none"
                                                accept="image/*" />
                                        </label>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <label for="exampleInputImage" class="form-label">{{ __('messages.setting.favicon') }}: </label>
                        <span data-bs-toggle="tooltip" data-placement="top"
                            data-bs-original-title="{{ __('messages.placeholder.best_resolution_for_this_favicon_will_be_32X32') }}">
                            <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
                        </span>
                    </div>
                    @php
                        $style2 =
                            'style="background-image: url(' .
                            ($setting['favicon'] ? asset($setting['favicon']) : asset('assets/image/infyom-logo.png')) .
                            ')"';
                    @endphp
                    <div class="col-lg-8">
                        <div class="mb-3" io-image-input="true">
                            <div class="d-block">
                                <div class="image-picker">
                                    <div class="image previewImage w-60px h-60px" id="exampleInputImage"
                                        {!! $style2 !!}>
                                    </div>
                                    <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                                        data-placement="top"
                                        data-bs-original-title="{{ __('messages.common.change_favicon') }}">
                                        <label>
                                            <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                            <input type="file" name="favicon" class="image-upload d-none"
                                                accept="image/*" />
                                        </label>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex pt-0 justify-content-start">
                    {{ Form::submit(__('messages.user.save_changes'), ['class' => 'btn btn-primary']) }}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
    <div class="container-fluid mt-5">
        <div class="card">
            <div class="card-header pb-0">
                <div class="card-title m-0">
                    <h3 class="m-0">{{ __('messages.payment_method') }}</h3>
                </div>
            </div>
            {{ Form::open(['route' => 'payment-setting.update', 'files' => true, 'id' => 'paymentForm', 'class' => 'form']) }}
            {{ Form::hidden('sectionName', $sectionName . '_1') }}
            <div class="card-body pt-0">
                <div class="card-body   p-3">
                    <div class="row mb-6">
                        <div class="table-responsive px-0">
                            <table>
                                <tbody class="d-flex flex-wrap">
                                    {{-- @foreach (\App\Models\Plan::PAYMENT_METHOD as $key => $paymentGateway)
                                    @if (checkPaymentGateway($key))
                                        <tr class="w-100 d-flex justify-content-between">
                                            <td class="p-2">
                                                <div class="form-check form-check-custom">
                                                    <input class="form-check-input" type="checkbox" value="{{$key}}"
                                                           name="payment_gateway[]"
                                                           id="{{$key}}" {{in_array($paymentGateway, $selectedPaymentGateways) ?'checked':''}} />
                                                    <label class="form-label" for="{{$key}}">
                                                       {{__('messages.setting.'.$paymentGateway)}}
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach --}}

                                    <div class="row mb-7">
                                             <tr >
                                                 <div class="form-check form-switch form-check-custom form-check-solid">
                                                     {!! Form::label('stripeCheckboxBtn', __('messages.setting.Stripe'), ['class' => 'form-check-label']) !!}
                                                     <input type="checkbox" name="stripe_checkbox_btn" class="form-check-input w-30px h-20px {{ auth()->user()->language == 'ar' ? 'float-none' : '' }}" id="stripeCheckboxBtn" {{ isset($setting['stripe_checkbox_btn']) && $setting['stripe_checkbox_btn'] == 1 ? 'checked' : '' }} value="1">
                                                 </div>
                                                 <div class="stripe-creds mt-5 {{ isset($setting['stripe_checkbox_btn']) && $setting['stripe_checkbox_btn'] == 1 ? '' : 'd-none'  }}">
                                                     <div class="form-group col-sm-6 col-md-6 mb-5">
                                                         {!! Form::label('stripeKey', __('messages.setting.stripe_key').':', ['class' => 'form-label required', 'for' => 'stripeKey']) !!}
                                                         {!! Form::text('stripe_key', $setting['stripe_key'] ?? null, ['class' => 'form-control required', 'placeholder' => __('messages.setting.stripe_key'), 'id' => 'stripeKey']) !!}
                                                     </div>
                                                     <div class="form-group col-sm-6 col-md-6 mb-5">
                                                         {!! Form::label('stripeSecret',  __('messages.setting.stripe_secret_key').':', ['class' => 'form-label required', 'for' => 'stripeSecret']) !!}
                                                         {!! Form::text('stripe_secret', $setting['stripe_secret'] ?? null, ['class' => 'form-control required', 'placeholder' =>  __('messages.setting.stripe_secret_key'), 'id' => 'stripeSecret']) !!}
                                                     </div>
                                                     <div id="errorContainer" class="mt-2 text-danger"></div>
                                                 </div>
                                             </tr>
                                         </div>

                                         <div class="row mb-7">
                                             <tr >
                                                 <div class="form-check form-switch form-check-custom form-check-solid">
                                                     {!! Form::label('paypalCheckboxBtn', __('messages.setting.Paypal'), ['class' => 'form-check-label']) !!}
                                                     <input type="checkbox" name="paypal_checkbox_btn" class="form-check-input w-30px h-20px {{ auth()->user()->language == 'ar' ? 'float-none' : '' }}" id="paypalCheckboxBtn" {{ isset($setting['paypal_checkbox_btn']) && $setting['paypal_checkbox_btn'] == 1 ? 'checked' : '' }} value="1">
                                                 </div>
                                                 <div class="paypal-creds mt-5 {{ isset($setting['paypal_checkbox_btn']) && $setting['paypal_checkbox_btn'] == 1 ? '' : 'd-none'  }}">
                                                     <div class="form-group col-sm-6 col-md-6 mb-5">
                                                         {!! Form::label('paypal_client_id', __('messages.setting.paypal_client_id').':', ['class' => 'form-label required', 'for' => 'paypalKey']) !!}
                                                         {!! Form::text('paypal_client_id', $setting['paypal_client_id'] ?? null, ['class' => 'form-control required', 'placeholder' => __('messages.setting.paypal_client_id'), 'id' => 'paypalKey']) !!}
                                                     </div>
                                                     <div class="form-group col-sm-6 col-md-6 mb-5">
                                                         {!! Form::label('paypal_secret', __('messages.setting.paypal_secret').':', ['class' => 'form-label required', 'for' => 'paypalSecret']) !!}
                                                         {!! Form::text('paypal_secret', $setting['paypal_secret'] ?? null, ['class' => 'form-control required', 'placeholder' => __('messages.setting.paypal_secret'), 'id' => 'paypalSecret']) !!}
                                                     </div>
                                                     <div class="form-group col-sm-6 mb-5">
                                                      {{ Form::label('paypal_mode', __('messages.setting.paypal_mode').':', ['class' => 'form-label required ']) }}
                                                      {{ Form::text('paypal_mode', $setting['paypal_mode'] ?? null, ['class' => 'form-control',  'placeholder' => __('messages.setting.paypal_mode') , 'id' => 'paypalMode']) }}
                                                  </div>
                                                 </div>
                                             </tr>
                                         </div>
                                         <div class="row mb-7">
                                             <tr >
                                                 <div class="form-check form-switch form-check-custom form-check-solid">
                                                     {!! Form::label('manuallyCheckboxBtn', __('messages.setting.Manually'), ['class' => 'form-check-label']) !!}
                                                     <input type="checkbox" name="manually_checkbox_btn" class="form-check-input w-30px h-20px {{ auth()->user()->language == 'ar' ? 'float-none' : '' }}" id="manuallyCheckboxBtn" {{ isset($setting['manually_checkbox_btn']) && $setting['manually_checkbox_btn'] == 1 ? 'checked' : '' }} value="1">
                                                 </div>
                                             </tr>
                                         </div>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-start ">
                    {{ Form::submit(__('messages.user.save_changes'), ['class' => 'btn btn-primary', 'id' => 'paymentMethodSave']) }}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
    <div class="container-fluid mt-5">
        <div class="card">
            <div class="card-header pb-0">
                <div class="card-title m-0">
                    <h3 class="m-0">{{ __('messages.setting.google_recaptcha') }}</h3>
                </div>
            </div>
            {{ Form::open(['route' => 'setting.update', 'files' => true, 'id' => 'kt_account_profile_details_form', 'class' => 'form']) }}
            {{ Form::hidden('sectionName', $sectionName . '_1') }}
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        {{ Form::label('show_captcha', __('messages.setting.show_capcha_register') . ':', [
                            'class' => 'form-label fs-6',
                        ]) }}
                    </div>
                    <div class="col-lg-8">
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input w-30px h-20px is-active {{ auth()->user()->language == 'ar' ? 'float-none' : '' }}" name="show_captcha_on_registration"
                                id="showCaptchaOnRegistration" type="checkbox" value="1"
                                {{ $setting['show_captcha_on_registration'] ? 'checked' : '' }}>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-4">
                        {{ Form::label('show_captcha', __('messages.setting.show_captcha') . ':', ['class' => 'form-label fs-6']) }}
                    </div>
                    <div class="col-lg-8">
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input w-30px h-20px is-active {{ auth()->user()->language == 'ar' ? 'float-none' : '' }} {{ auth()->user()->language == 'ar' ? 'float-none' : '' }}" name="show_captcha" id="showCaptcha"
                                type="checkbox" value="1" {{ $setting['show_captcha'] ? 'checked' : '' }}>
                        </div>
                    </div>
                </div>
                <div
                    class="row mt-5 mb-5 captchaOptions {{ $setting['show_captcha'] || $setting['show_captcha_on_registration'] ? '' : 'd-none' }}">
                    <div class="col-lg-4">
                        {{ Form::label('site_key', __('messages.setting.site_key') . ':', ['class' => 'form-label required fs-6']) }}
                    </div>
                    <div class="col-lg-8">
                        {{ Form::text('site_key', $setting['site_key'] ?? null, ['class' => 'form-control', 'placeholder' => __('messages.setting.site_key')]) }}
                    </div>
                </div>
                <div
                    class="row mb-5 captchaOptions {{ $setting['show_captcha'] || $setting['show_captcha_on_registration'] ? '' : 'd-none' }}">
                    <div class="col-lg-4">
                        {{ Form::label('secret_key', __('messages.setting.secret_key') . ':', [
                            'class' => 'col-lg-4 form-label required fs-6',
                        ]) }}
                    </div>
                    <div class="col-lg-8">
                        {{ Form::text('secret_key', $setting['secret_key'] ?? null, ['class' => 'form-control', 'placeholder' => __('messages.setting.secret_key')]) }}
                    </div>
                </div>
                <div class="d-flex justify-content-start mt-5">
                    {{ Form::submit(__('messages.user.save_changes'), ['class' => 'btn btn-primary']) }}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
    <div class="container-fluid mt-5">
         <div class="card">
             <div class="card-header pb-0">
                 <div class="card-title m-0">
                     <h3 class="m-0">{{ __('messages.post.open_ai') }}</h3>
                 </div>
             </div>
             {{ Form::open(['route' => 'ai-setting.update',  'class' => 'form']) }}
             {{ Form::hidden('sectionName', $sectionName . '_1') }}
             <div class="card-body">
                 <div class="row">
                  <div class="form-group col-sm-6 col-md-6 mb-5">
                           {!! Form::label('open_AI_key', __('messages.setting.open_ai_key').':', ['class' => 'form-label ', 'for' => 'openAiKey']) !!}
                           {!! Form::text('open_AI_key', $setting['open_AI_key'] ?? null, ['class' => 'form-control required', 'placeholder' => __('messages.setting.open_ai_key'), 'id' => 'openAiKey', 'onkeyup' => "this.value = this.value.replace(/\\s/g, '');"]) !!}
                  </div>

                 </div>
                 <div class="d-flex justify-content-start mt-5">
                     {{ Form::submit(__('messages.user.save_changes'), ['class' => 'btn btn-primary']) }}
                 </div>
             </div>
             {{ Form::close() }}
         </div>
     </div>
    <div class="container-fluid mt-5">
        <div class="card">
            <div class="card-header">
                <div class="card-title m-0">
                    <h3 class="m-0">{{ __('messages.setting.social_media_sharing') }}</h3>
                </div>
            </div>
            {{ Form::open(['route' => 'setting.update', 'files' => true, 'id' => 'kt_account_profile_details_form', 'class' => 'form']) }}
            {{ Form::hidden('sectionName', $sectionName . '_2') }}
            <div class="card-body pt-0">
                <div class="row mt-5">
                    <div class="col-lg-4">
                        {{ Form::label('show_captcha', __('messages.setting.whatsapp') . ':', ['class' => 'form-label fs-6']) }}
                    </div>
                    <div class="col-lg-8">
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input w-30px h-20px is-active {{ auth()->user()->language == 'ar' ? 'float-none' : '' }}" name="whatsapp" id="whatsapp"
                                type="checkbox" value="1" {{ $setting['whatsapp'] ? 'checked' : '' }}>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-4">
                        {{ Form::label('show_captcha', __('messages.setting.linkedIn') . ':', ['class' => 'form-label fs-6']) }}
                    </div>
                    <div class="col-lg-8">
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input w-30px h-20px is-active {{ auth()->user()->language == 'ar' ? 'float-none' : '' }}" name="linkedin" id="linkedin"
                                type="checkbox" value="1" {{ $setting['linkedin'] ? 'checked' : '' }}>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-4">
                        {{ Form::label('show_captcha', __('messages.setting.twitter') . ':', ['class' => 'form-label fs-6']) }}
                    </div>
                    <div class="col-lg-8">
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input w-30px h-20px is-active {{ auth()->user()->language == 'ar' ? 'float-none' : '' }}" name="twitter" id="twitter"
                                type="checkbox" value="1" {{ $setting['twitter'] ? 'checked' : '' }}>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-4">
                        {{ Form::label('show_captcha', __('messages.setting.facebook') . ':', ['class' => 'form-label fs-6']) }}
                    </div>
                    <div class="col-lg-8">
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input w-30px h-20px is-active {{ auth()->user()->language == 'ar' ? 'float-none' : '' }}" name="facebook" id="facebook"
                                type="checkbox" value="1" {{ $setting['facebook'] ? 'checked' : '' }}>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-4">
                        {{ Form::label('show_captcha', __('messages.setting.reddit') . ':', ['class' => 'form-label fs-6']) }}
                    </div>
                    <div class="col-lg-8">
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input w-30px h-20px is-active {{ auth()->user()->language == 'ar' ? 'float-none' : '' }}" name="reddit" id="reddit"
                                type="checkbox" value="1" {{ $setting['reddit'] ? 'checked' : '' }}>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-start mt-5">
                    {{ Form::submit(__('messages.user.save_changes'), ['class' => 'btn btn-primary']) }}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
    {{--    <div class="container-fluid mt-5"> --}}
    {{--        <div class="card"> --}}
    {{--            <div class="card-header"> --}}
    {{--                <div class="card-title m-0"> --}}
    {{--                    <h3 class="m-0">{{ __('messages.setting.download-db') }}</h3> --}}
    {{--                </div> --}}
    {{--            </div> --}}
    {{--            <div class="card-body"> --}}
    {{--                <a href="{{route('db-download')}}" class="btn btn-primary"> --}}

    {{--                    {{ __('messages.setting.download-db') }} --}}
    {{--                    <i class="fa-solid fa-download px-2"></i> --}}
    {{--                </a> --}}

    {{--            </div> --}}
    {{--            {{ Form::close() }} --}}
    {{--        </div> --}}
    {{--    </div> --}}
@endsection
{{-- @section('page_js') --}}
{{--    <script src="{{asset('/web/plugins/custom/tinymce/tinymce.bundle.js')}}"></script> --}}
{{--    <script src="{{mix('assets/js/settings/settings.js')}}"></script> --}}
{{-- @endsection --}}
