@extends('layouts.app')
@section('title')
    {{__('messages.settings')}}
@endsection

@section('content')
        <div class="container-fluid">
            @include('setting.setting_menu')
            <div class="card">
                <div class="card-header">
                    <div class="card-title m-0">
                        <h3 class="m-0">{{__('messages.setting.cms')}}</h3>
                    </div>
                </div>
                <div class="collapse show">
                    {{ Form::open([ 'files' => true, 'id'=>'cmsForm','class'=>'form']) }}
                    {{ Form::hidden('sectionName', $sectionName) }}
                    <div class="card-body">
                        <div class="row mb-5">
                            {{ Form::label('terms&conditions',__('messages.setting.terms-conditions').':',
                                     ['class'=>'form-label required fw-bold fs-6']) }}
                            <div class="col-lg-12 fv-row">
                                 {{-- <textarea id="terms_condition" name="terms&conditions"
                                           class="tox-target setting-text-description cke_rtl">
                                    {!! $setting['terms&conditions']??null!!}
                                 </textarea> --}}
                                 <div class="col-lg-12 fv-row">
                                    <div id="addTermsConditionsQuillData" class=""></div>
                                    {{ Form::hidden('terms&conditions', $setting['terms&conditions']??null, ['id' => 'termsConditions']) }}
                                 </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            {{ Form::label('support',__('messages.setting.support').':',
                                     ['class'=>'form-label required fw-bold fs-6']) }}
                            <div class="col-lg-12 fv-row">
                               {{-- <textarea id="support" name="support"
                                         class="tox-target setting-text-description">
                                    {!! $setting['support']??null !!}
                               </textarea> --}}
                                <div class="col-lg-12 fv-row">
                                    <div id="addSupportQuillData" class=""></div>
                                    {{ Form::hidden('support', $setting['support']??null, ['id' => 'support']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row mb-8">
                            {{ Form::label('privacy',__('messages.setting.privacy').':',
                                     ['class'=>'form-label required fw-bold fs-6']) }}
                            <div class="col-lg-12 fv-row">
                                {{-- <textarea id="privacyPolicy" name="privacy"
                                          class="tox-target setting-text-description">
                                    {!!  $setting['privacy']??null !!}
                                </textarea> --}}
                                <div class="col-lg-12 fv-row">
                                    <div id="addPrivacyQuillData" class=""></div>
                                    {{ Form::hidden('privacy', $setting['privacy']??null, ['id' => 'privacy']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            {{ Form::label('manual_payment_guide',__('messages.setting.manual_payment_guide').':',
                                     ['class'=>'form-label fw-bold fs-6']) }}
                            <div class="col-lg-12 fv-row">
                                 {{-- <textarea id="manualPaymentGuide" name="manual_payment_guide"
                                           class="tox-target setting-text-description">
                                    {!! $setting['manual_payment_guide']??null!!}
                                 </textarea> --}}
                                 <div class="col-lg-12 fv-row">
                                    <div id="addManualPaymentGuideQuillData" class=""></div>
                                    {{ Form::hidden('manual_payment_guide', $setting['manual_payment_guide']??null, ['id' => 'manualPaymentGuide']) }}
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-start">
                            {{ Form::submit(__('messages.user.save_changes'),['class' => 'btn btn-primary']) }}
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
@endsection

{{--        @section('page_js')--}}
{{--            <script>--}}
{{--                let isEdit = true;--}}

{{--            </script>--}}
{{--            <script src="{{asset('/web/plugins/custom/tinymce/tinymce.bundle.js')}}"></script>--}}
{{--            <script src="{{mix('assets/js/settings/settings.js')}}"></script>--}}
{{--@endsection--}}
