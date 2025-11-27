<div>
    <div>
        {{ Form::label('ad_space', __('messages.ad_space.select_ad_space') . ' :', ['class' => 'form-label required']) }}
        {{ Form::select('ad_space', App\Models\AdSpaces::AD_SPACE, $sectionID, ['class' => 'form-select', 'id' => 'AdSpace', 'data-control' => 'select2', 'required']) }}
    </div>
    <hr>
    <div class="row">
        @if ($sectionID != App\Models\AdSpaces::ALL_DETAILS_SIDE && $sectionID != App\Models\AdSpaces::ALL_DETAILS_SIDE_THEME_1)
            <span class="fs-3 mb-4">{{ __('messages.ad_space.desktop') }}</span>
            <div class="col-lg-6 col-md-12">
                <div>
                    <div>
                        {{ Form::label('name', __('messages.ad_space.ad_url') . ':', ['class' => 'form-label required fs-6']) }}
                        {{ Form::url('ad_url[]', !empty($adBanner) ? $adBanner[0]->ad_url : '', ['class' => 'form-control', 'placeholder' => __('messages.ad_space.ad_url')]) }}
                        <div class="my-5">
                            @if (in_array($sectionID,[12,13,14,16,17]))
                                <div class="font-weight-bolder">{{ __('messages.allowed_file_size') }} 1280 X 150</div>
                            @else
                                <div class="font-weight-bolder">{{ __('messages.allowed_file_size') }} 800 X 130</div>
                            @endif
                            <input type="hidden" value="{{ App\Models\AdSpaces::DESKTOP }}" name="ad_view[]">
                            <input type="file" class="form-control" id="adBannerImageDesktop"
                                accept=".png, .jpg, .jpeg,.webp,.svg" name="ad_banner[]"
                                value="{{ !empty($adBanner) ? $adBanner[0]->ad_banner : '' }}">
                        </div>
                    </div>
                </div>
                <div>
                    <div class="row">
                        <div class="my-5">
                            <div id="preview" class="ad-banner-img-preview">
                                <img src="{{ !empty($adBanner) ? $adBanner[0]->ad_banner : '' }}" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                {{ Form::label('name', __('messages.ad_space.ad_code') . ':', ['class' => 'form-label required fs-6']) }}
                <textarea rows="10" name="ad_code[]" class="w-100">{{ !empty($adBanner[0]->code) ? $adBanner[0]->code : '' }}</textarea>
            </div>
            <hr>
        @endif
        @if ($sectionID != App\Models\AdSpaces::HEADER && $sectionID != App\Models\AdSpaces::ALL_DETAILS_SIDE && $sectionID != App\Models\AdSpaces::ALL_DETAILS_SIDE_THEME_1)
            <span class="fs-3 mb-4">{{ __('messages.ad_space.mobile') }}</span>
            <div class="col-lg-6 col-md-12">
                <div>
                    <div>
                        {{ Form::label('name', __('messages.ad_space.ad_url') . ':', ['class' => 'form-label required fs-6']) }}
                        {{ Form::url('ad_url[]', !empty($adBanner) ? $adBanner[1]->ad_url : '', ['class' => 'form-control', 'placeholder' => __('messages.ad_space.ad_url')]) }}
                        <div class="my-5">
                            @if (in_array($sectionID,[12,13,14,16,17]))
                                <div class="font-weight-bolder">{{ __('messages.allowed_file_size') }} 407 X 340</div>
                            @else
                                <div class="font-weight-bolder">{{ __('messages.allowed_file_size') }} 350 X 290</div>
                            @endif
                            <input type="hidden" value="{{ App\Models\AdSpaces::MOBILE }}" name="ad_view[]">
                            <input type="file" class="form-control" id="adBannerImageMobile"
                                accept=".png, .jpg, .jpeg,.webp,.svg" name="ad_banner[]"
                                value="{{ !empty($adBanner) ? $adBanner[1]->ad_banner : '' }}">
                        </div>
                    </div>
                </div>
                <div>
                    <div class="row">
                        <div>
                            <div id="previewMobile" class="ad-banner-img-previewM">
                                <img src="{{ !empty($adBanner) ? $adBanner[1]->ad_banner : '' }}" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 mt-2">
                {{ Form::label('name', __('messages.ad_space.ad_code') . ':', ['class' => 'form-label required fs-6']) }}
                <textarea rows="10" class="w-100" name="ad_code[]">{{ !empty($adBanner[1]->code) ? $adBanner[1]->code : '' }}</textarea>
            </div>
        @endif
    </div>
    @if ($sectionID == App\Models\AdSpaces::ALL_DETAILS_SIDE)
        <div class="row">
            <span class="fs-3 mb-4">{{ __('messages.ad_space.mobile') }}</span>
            <div class="col-lg-6 col-md-12">
                <div>
                    <div>
                        {{ Form::label('name', __('messages.ad_space.ad_url') . ':', ['class' => 'form-label required fs-6']) }}
                        {{ Form::url('ad_url[]', !empty($adBanner) ? $adBanner[0]->ad_url : '', ['class' => 'form-control', 'placeholder' => __('messages.setting.site_key')]) }}
                        <div class="my-5">
                            <div class="font-weight-bolder">{{ __('messages.allowed_file_size') }} 350 X 290</div>
                            <input type="hidden" value="{{ App\Models\AdSpaces::MOBILE }}" name="ad_view[]">
                            <input type="file" class="form-control" id="adBannerImageMobile"
                                accept=".png, .jpg, .jpeg,.webp,.svg" name="ad_banner[]"
                                value="{{ !empty($adBanner) ? $adBanner[0]->ad_banner : '' }}">
                        </div>
                    </div>
                </div>
                <div>
                    <div class="row">
                        <div>
                            <div id="previewMobile" class="ad-banner-img-previewM">
                                <img src="{{ !empty($adBanner) ? $adBanner[0]->ad_banner : '' }}" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 mt-2">
                {{ Form::label('name', __('messages.ad_space.ad_code') . ':', ['class' => 'form-label required fs-6']) }}
                <textarea rows="10" class="w-100" name="ad_code[]">{{ !empty($adBanner[0]->code) ? $adBanner[0]->code : '' }}</textarea>
            </div>

        </div>
    @endif
    @if ($sectionID == App\Models\AdSpaces::ALL_DETAILS_SIDE_THEME_1)
        <div class="row">
            <span class="fs-3 mb-4">{{ __('messages.ad_space.mobile') }}</span>
            <div class="col-lg-6 col-md-12">
                <div>
                    <div>
                        {{ Form::label('name', __('messages.ad_space.ad_url') . ':', ['class' => 'form-label required fs-6']) }}
                        {{ Form::url('ad_url[]', !empty($adBanner) ? $adBanner[0]->ad_url : '', ['class' => 'form-control', 'placeholder' => __('messages.setting.site_key')]) }}
                        <div class="my-5">
                            <div class="font-weight-bolder">{{ __('messages.allowed_file_size') }} 407 X 340</div>
                            <input type="hidden" value="{{ App\Models\AdSpaces::MOBILE }}" name="ad_view[]">
                            <input type="file" class="form-control" id="adBannerImageMobile"
                                accept=".png, .jpg, .jpeg,.webp,.svg" name="ad_banner[]"
                                value="{{ !empty($adBanner) ? $adBanner[0]->ad_banner : '' }}">
                        </div>
                    </div>
                </div>
                <div>
                    <div class="row">
                        <div>
                            <div id="previewMobile" class="ad-banner-img-previewM">
                                <img src="{{ !empty($adBanner) ? $adBanner[0]->ad_banner : '' }}" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 mt-2">
                {{ Form::label('name', __('messages.ad_space.ad_code') . ':', ['class' => 'form-label required fs-6']) }}
                <textarea rows="10" class="w-100" name="ad_code[]">{{ !empty($adBanner[0]->code) ? $adBanner[0]->code : '' }}</textarea>
            </div>
        </div>
    @endif
    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary mt-3 me-2']) }}
</div>
