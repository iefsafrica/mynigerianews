@extends('theme1.layouts.app')
@section('title')
    {{ __('messages.common.contact_us') }}
@endsection
@php
    $settings = App\Models\Setting::pluck('value', 'key')->toArray();
@endphp
@section('content')
    <div class="lg:pt-20 md:pt-14 xs:pt-12 pt-10">
        <div class="contact-container container mx-auto max-w-7xl xl:px-0 lg:px-10 md:px-8 px-4">
            <div class="text-center relative">
                <div class="lg:text-6xl sm:text-5xl text-4xl pb-3 text-gray-100 font-semibold">
                    Contact Us
                </div>
                <h3 class="text-black font-semibold lg:text-3xl text-2xl absolute bottom-0 left-0 right-0 mx-auto">
                    {{ __('messages.common.contact_us') }}
                </h3>
            </div>
            <div class="lg:pt-20 md:pt-14 xs:pt-12 pt-10">
                <div class="grid lg:grid-cols-2 lg:gap-8 gap-10">
                    <div class="light-gray-bg rounded-xl lg:p-8 p-6">
                        <h5 class="text-2xl font-semibold lg:mb-8 sm:mb-7 mb-6">
                            {{ __('messages.get_in_touch') }}
                        </h5>
                        <p class="text-gray-200 font-medium lg:mb-8 sm:mb-7 mb-6">
                            {!! $settings['about_text'] !!}
                        </p>
                        <div class="flex lg:mb-8 sm:mb-7 mb-6">
                            <div class="w-8 lg:me-5 me-4">
                                <svg width="30" height="27" viewBox="0 0 30 27" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M29.3624 27.0002H0.637567C0.285439 27.0002 0 26.7161 0 26.3658C0 26.0155 0.285439 25.7314 0.637567 25.7314H29.3624C29.7145 25.7314 30 26.0155 30 26.3658C30 26.7161 29.7145 27.0002 29.3624 27.0002Z"
                                        fill="#181D27" />
                                    <path
                                        d="M20.3154 4.31502H11.8881C11.5359 4.31502 11.2505 4.03101 11.2505 3.68064V0.634385C11.2505 0.284014 11.5359 0 11.8881 0H20.3154C20.6675 0 20.953 0.284014 20.953 0.634385V3.68064C20.953 4.03101 20.6675 4.31502 20.3154 4.31502ZM12.5257 3.04625H19.6779V1.26877H12.5257V3.04625Z"
                                        fill="#181D27" />
                                    <path
                                        d="M23.2918 27.0006H8.90954C8.55741 27.0006 8.27197 26.7165 8.27197 26.3662V3.68126C8.27197 3.33089 8.55741 3.04688 8.90954 3.04688H23.2918C23.6439 3.04688 23.9294 3.33089 23.9294 3.68126V10.2125C23.9294 10.5629 23.6439 10.8469 23.2918 10.8469C22.9398 10.8469 22.6543 10.5629 22.6543 10.2125V4.31564H9.54711V25.7318H23.2918C23.6439 25.7318 23.9294 26.0159 23.9294 26.3662C23.9294 26.7165 23.6439 27.0006 23.2918 27.0006Z"
                                        fill="#181D27" />
                                    <path
                                        d="M8.90972 27.0009H3.41198C3.05985 27.0009 2.77441 26.7168 2.77441 26.3665V12.2574C2.77441 11.9071 3.05985 11.623 3.41198 11.623H8.90972C9.26185 11.623 9.54729 11.9071 9.54729 12.2574V26.3665C9.54729 26.7169 9.26185 27.0009 8.90972 27.0009ZM4.04955 25.7322H8.27215V12.8918H4.04955V25.7322Z"
                                        fill="#181D27" />
                                    <path
                                        d="M8.90946 12.8911H5.24792C4.89579 12.8911 4.61035 12.6071 4.61035 12.2568V9.03966C4.61035 8.68929 4.89579 8.40527 5.24792 8.40527H8.90946C9.26159 8.40527 9.54703 8.68929 9.54703 9.03966V12.2568C9.54703 12.6071 9.26159 12.8911 8.90946 12.8911ZM5.88542 11.6224H8.27183V9.67404H5.88542V11.6224Z"
                                        fill="#181D27" />
                                    <path
                                        d="M17.6259 26.9986H14.577C14.2249 26.9986 13.9395 26.7145 13.9395 26.3642V21.3219C13.9395 20.9716 14.2249 20.6875 14.577 20.6875H17.6259C17.978 20.6875 18.2635 20.9716 18.2635 21.3219V26.3642C18.2635 26.7145 17.978 26.9986 17.6259 26.9986ZM15.2146 25.7298H16.9883V21.9563H15.2146V25.7298Z"
                                        fill="#181D27" />
                                    <path
                                        d="M23.2448 27.0002C23.0131 27.0002 22.7997 26.8752 22.6873 26.6736C22.3283 26.0299 21.7734 25.1513 21.1308 24.1341C18.8155 20.4688 17.0444 17.5353 17.0444 15.9036C17.0444 12.5008 19.8259 9.73242 23.2448 9.73242C26.6647 9.73242 29.447 12.5008 29.447 15.9036C29.447 17.7511 27.3116 21.0934 25.4275 24.0422C24.7885 25.0425 24.1849 25.9872 23.8023 26.6736C23.69 26.8752 23.4765 27.0002 23.2448 27.0002ZM23.2448 11.0011C20.529 11.0011 18.3196 13.2004 18.3196 15.9035C18.3196 17.2994 20.661 21.0061 22.2104 23.4589C22.5925 24.0638 22.944 24.6204 23.2452 25.1131C23.5668 24.5896 23.9423 24.0019 24.3515 23.3615C25.9637 20.838 28.1718 17.3819 28.1718 15.9035C28.1719 13.2004 25.9616 11.0011 23.2448 11.0011Z"
                                        fill="#181D27" />
                                    <path
                                        d="M23.2447 18.8017C21.5229 18.8017 20.1221 17.4071 20.1221 15.6929C20.1221 13.9797 21.5229 12.5859 23.2447 12.5859C24.9675 12.5859 26.3691 13.9797 26.3691 15.6929C26.3691 17.4071 24.9675 18.8017 23.2447 18.8017ZM23.2447 13.8548C22.226 13.8548 21.3972 14.6793 21.3972 15.693C21.3972 16.7075 22.226 17.533 23.2447 17.533C24.2643 17.533 25.0939 16.7075 25.0939 15.693C25.0939 14.6793 24.2644 13.8548 23.2447 13.8548Z"
                                        fill="#181D27" />
                                    <path
                                        d="M15.363 11.3138C15.0109 11.3138 14.7255 11.0298 14.7255 10.6794V8.65061H12.8108V10.6794C12.8108 11.0298 12.5253 11.3138 12.1732 11.3138C11.8211 11.3138 11.5356 11.0298 11.5356 10.6794V8.01622C11.5356 7.66585 11.8211 7.38184 12.1732 7.38184H15.363C15.7151 7.38184 16.0006 7.66585 16.0006 8.01622V10.6794C16.0006 11.0298 15.7151 11.3138 15.363 11.3138Z"
                                        fill="#181D27" />
                                    <path
                                        d="M15.3635 16.6056C15.0114 16.6056 14.7259 16.3216 14.7259 15.9712V13.9406H12.8113V15.9712C12.8113 16.3216 12.5258 16.6056 12.1737 16.6056C11.8216 16.6056 11.5361 16.3216 11.5361 15.9712V13.3063C11.5361 12.9559 11.8216 12.6719 12.1737 12.6719H15.3635C15.7156 12.6719 16.0011 12.9559 16.0011 13.3063V15.9712C16.0011 16.3216 15.7156 16.6056 15.3635 16.6056Z"
                                        fill="#181D27" />
                                </svg>
                            </div>
                            <p class="text-base font-medium text-gray-300">
                                {!! $settings['contact_address'] !!}
                            </p>
                        </div>
                        <div class="flex lg:mb-8 sm:mb-7 mb-6">
                            <div class="w-8 lg:me-5 me-4">
                                <svg width="30" height="22" viewBox="0 0 30 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M27.5 0H2.50002C1.12119 0 0 1.09628 0 2.44446V19.5556C0 20.9037 1.12119 22 2.50002 22H27.5C28.8788 22 30 20.9037 30 19.5555V2.44446C30 1.09628 28.8788 0 27.5 0ZM2.50002 1.2222H27.5C27.5921 1.2222 27.6733 1.25503 27.7597 1.27359C25.5953 3.21045 18.4185 9.6301 15.907 11.8426C15.7105 12.0157 15.3938 12.2222 15.0001 12.2222C14.6064 12.2222 14.2896 12.0157 14.0924 11.8421C11.5812 9.62987 4.40396 3.20988 2.23992 1.27371C2.32652 1.25515 2.40785 1.2222 2.50002 1.2222ZM1.24998 19.5555V2.44446C1.24998 2.32472 1.28689 2.2161 1.31994 2.10667C2.9765 3.58915 7.98416 8.06844 11.2312 10.9555C7.99471 13.6739 2.98576 18.3172 1.31602 19.8741C1.28654 19.7702 1.24998 19.6685 1.24998 19.5555ZM27.5 20.7778H2.50002C2.40018 20.7778 2.31141 20.7438 2.21818 20.722C3.94359 19.1137 8.98441 14.4436 12.164 11.784C12.5785 12.1516 12.9571 12.4868 13.2556 12.7498C13.7708 13.2046 14.3737 13.4445 15 13.4445C15.6263 13.4445 16.2292 13.2045 16.7438 12.7504C17.0423 12.4873 17.4213 12.1518 17.836 11.784C21.0158 14.4433 26.0559 19.1131 27.7818 20.722C27.6886 20.7438 27.5999 20.7778 27.5 20.7778ZM28.75 19.5555C28.75 19.6685 28.7135 19.7702 28.684 19.8741C27.0137 18.3164 22.0053 13.6736 18.7689 10.9556C22.016 8.0685 27.0229 3.58961 28.6801 2.10656C28.7131 2.21598 28.75 2.32467 28.75 2.44441V19.5555Z"
                                        fill="#181D27" />
                                </svg>
                            </div>
                            <a href="mailto:{{ $settings['email'] }}" class="text-base font-medium text-gray-300">
                                {{ $settings['email'] }}
                            </a>
                        </div>
                        <div class="flex items-center">
                            <div class="w-8 lg:me-5 me-4">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6.07937 19.942C9.04955 23.4791 12.625 26.264 16.7059 28.2346C18.2596 28.9681 20.3375 29.8384 22.6525 29.9876C22.796 29.9938 22.9333 30 23.0768 30C24.6306 30 25.8785 29.4654 26.8956 28.3651C26.9019 28.3589 26.9144 28.3465 26.9206 28.334C27.2825 27.8989 27.6944 27.5073 28.1249 27.0908C28.4182 26.811 28.7177 26.5189 29.0047 26.2205C30.3338 24.8404 30.3338 23.0874 28.9923 21.7509L25.2421 18.0149C24.6056 17.356 23.8443 17.0079 23.0456 17.0079C22.2469 17.0079 21.4794 17.356 20.8242 18.0087L18.5903 20.2341C18.3844 20.116 18.1723 20.0104 17.9726 19.9109C17.723 19.7866 17.4921 19.6685 17.2862 19.5379C15.252 18.2511 13.405 16.5727 11.6391 14.4157C10.7468 13.2905 10.1478 12.3456 9.7297 11.3821C10.3163 10.8537 10.8654 10.3005 11.3958 9.75963C11.583 9.56693 11.7764 9.37422 11.9698 9.18152C12.6437 8.51015 13.0056 7.73311 13.0056 6.94364C13.0056 6.15416 12.65 5.37712 11.9698 4.70576L10.1103 2.85329C9.89194 2.63572 9.68602 2.42437 9.47387 2.2068C9.06203 1.78409 8.63148 1.34894 8.20717 0.957315C7.56446 0.329465 6.80943 0 6.01073 0C5.21826 0 4.45699 0.329465 3.78932 0.963531L1.4556 3.28844C0.606979 4.13386 0.126507 5.15955 0.0266688 6.34687C-0.0918892 7.83257 0.182666 9.41152 0.894014 11.3199C1.986 14.2727 3.63333 17.0141 6.07937 19.942ZM1.5492 6.47741C1.62408 5.65064 1.94232 4.96063 2.54135 4.36386L4.86259 2.05139C5.2245 1.70327 5.62385 1.523 6.01073 1.523C6.39136 1.523 6.77823 1.70327 7.13391 2.06382C7.55198 2.44923 7.94509 2.85329 8.36941 3.28222C8.58156 3.49979 8.79996 3.71736 9.01835 3.94115L10.8778 5.79362C11.2647 6.17903 11.4644 6.57066 11.4644 6.95607C11.4644 7.34148 11.2647 7.73311 10.8778 8.11853C10.6844 8.31123 10.491 8.51015 10.2975 8.70286C9.71722 9.28719 9.17435 9.84045 8.57532 10.3688C8.56284 10.3813 8.5566 10.3875 8.54412 10.3999C8.02621 10.9159 8.10733 11.407 8.23213 11.7799C8.23837 11.7986 8.24461 11.811 8.25085 11.8297C8.73132 12.9797 9.39899 14.0738 10.4411 15.3792C12.313 17.6792 14.2848 19.4633 16.4563 20.8371C16.7246 21.0112 17.0117 21.1479 17.28 21.2847C17.5296 21.409 17.7604 21.5271 17.9664 21.6577C17.9913 21.6701 18.01 21.6826 18.035 21.695C18.2409 21.8007 18.4406 21.8504 18.6403 21.8504C19.1395 21.8504 19.4639 21.5334 19.57 21.4277L21.9037 19.1028C22.2656 18.7422 22.6588 18.5495 23.0456 18.5495C23.5199 18.5495 23.9067 18.8417 24.1501 19.1028L27.9128 22.845C28.6615 23.591 28.6553 24.3991 27.894 25.1886C27.632 25.4683 27.3574 25.7356 27.0641 26.0153C26.6273 26.438 26.1718 26.8732 25.76 27.3643C25.0424 28.1351 24.1875 28.4956 23.0831 28.4956C22.977 28.4956 22.8647 28.4894 22.7586 28.4832C20.7119 28.3527 18.8087 27.557 17.3798 26.8794C13.4986 25.0083 10.0916 22.3539 7.26495 18.9847C4.93746 16.1935 3.37125 13.5951 2.33543 10.8102C1.69272 9.1007 1.44936 7.7269 1.5492 6.47741Z"
                                        fill="#181D27" />
                                </svg>
                            </div>
                            <a href="tel:{{ $settings['contact_no'] }}" class="text-base font-medium text-gray-300">
                                {{ $settings['contact_no'] }}
                            </a>
                        </div>
                    </div>
                    <div class="">
                        <form id="contactUsFrom">
                            <div class="mb-5">
                                <input type="text" name="name"
                                    class="border rounded-lg py-3.5 px-5 text-sm font-medium text-gray-300 placeholder:text-gray-300 w-full focus:outline-none"
                                    placeholder="{{ __('messages.contact_us.enter_your_name') }}" />
                            </div>
                            <div class="mb-5">
                                <input type="email" name="email"
                                    class="border rounded-lg py-3.5 px-5 text-sm font-medium text-gray-300 placeholder:text-gray-300 w-full focus:outline-none"
                                    placeholder="{{ __('messages.contact_us.enter_your_email') }}" />
                            </div>
                            <div class="mb-5">
                                <input type="tel" name="phone"
                                    class="{{ getFrontSelectLanguageIsoCode() == 'ar' ? 'text-end' : 'text-start' }} border rounded-lg py-3.5 px-5 text-sm font-medium text-gray-300 placeholder:text-gray-300 w-full focus:outline-none"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                    placeholder="{{ __('messages.comment.enter_phone_number') }}" />
                            </div>
                            <div class="mb-5">
                                <textarea type="text" name="message" rows="4"
                                    class="border rounded-lg py-3.5 px-5 text-sm font-medium text-gray-300 placeholder:text-gray-300 w-full focus:outline-none"
                                    placeholder="{{ __('messages.contact_us.enter_your_message') }}"></textarea>
                            </div>
                            @if ($settings['show_captcha'] == '1')
                                <div class="mb-5">
                                    <div class="g-recaptcha" id="gRecaptchaContainerContactUs"
                                        data-sitekey="{{ $settings['site_key'] }}"></div>
                                    <div id="g-recaptcha-error"></div>
                                </div>
                                <input type="hidden" value="{{ $settings['show_captcha'] }}" id="contactPageGoogleCaptch">
                            @endif
                            <div class="text-end">
                                <button class="bg-primary text-white rounded-lg font-bold text-sm py-3 px-10">
                                    {{ __('messages.common.send') . ' ' . __('messages.emails.message') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- advertiesment -->
    @if (checkAdSpaced('categories'))
        <div class="lg:pt-20 md:pt-14 xs:pt-12 pt-10 index-top-desktop">
            <div class="container mx-auto max-w-7xl xl:px-0 lg:px-10 md:px-8 px-4">
                @if (isset(getAdImageDesktop(\App\Models\AdSpaces::CATEGORIES_THEME_1)->code))
                <div class="index-top-desktop">
                    {!! getAdImageDesktop(\App\Models\AdSpaces::CATEGORIES_THEME_1)->code !!}
                </div>
            @elseif($adRecord = getAdImageDesktop(\App\Models\AdSpaces::CATEGORIES_THEME_1))
                <div class="bg-gray-100 container max-w-7xl rounded-xl mx-auto">
                    <a href="{{ $adRecord->ad_url }}" target="_blank">
                        <img src="{{ asset($adRecord->ad_banner) }}"
                            class="rounded-xl object-fill" loading="lazy">
                    </a>
                </div>
            @endif
            </div>
        </div>
        <div class="lg:pt-20 md:pt-14 xs:pt-12 pt-10 index-top-mobile">
            <div class="container mx-auto max-w-7xl xl:px-0 lg:px-10 md:px-8 px-4">
                <div class="lg:flex lg:gap-8 gap-10">
                    <div class="mb-8">
                        @if (isset(getAdImageMobile(\App\Models\AdSpaces::CATEGORIES_THEME_1)->code))
                        <div class="index-top-desktop">
                            {!! getAdImageMobile(\App\Models\AdSpaces::CATEGORIES_THEME_1)->code !!}
                        </div>
                    @elseif($adRecord = getAdImageMobile(\App\Models\AdSpaces::CATEGORIES_THEME_1))
                        <div class="flex justify-center items-center rounded-xl mx-auto">
                            <a href="{{ $adRecord->ad_url }}"
                                target="_blank">
                                <img src="{{ asset($adRecord->ad_banner) }}"
                                    class="rounded-xl object-fill md:h-[340px] md:w-[407px] lg:h-[340px] lg:w-[407px] sm:h-[340px] sm:w-[407px]"
                                    loading="lazy">
                            </a>
                        </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
