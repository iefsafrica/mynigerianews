
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3 col-xl-2">
                <div class="maan-slide-title">
                    <span class="icon"><svg viewBox="0 0 512 512"> <path d="M422.7,278.3c-0.1-3.8-2.2-7.3-5.6-9.2l-123.4-65.6l104.6-147c3.3-4.9,2-11.6-2.9-14.8c-3.3-2.3-7.7-2.4-11.2-0.5 L94.6,224.3c-5.1,3-6.8,9.6-3.8,14.6c1,1.7,2.4,3.1,4.2,4l121.6,64.6L116,457.1c-3.1,5-1.7,11.6,3.3,14.8c3.4,2.1,7.6,2.2,11.1,0.3 l287.3-184.4C420.9,285.7,422.9,282.1,422.7,278.3L422.7,278.3z"/></svg></span>
                    <h6>{{ __('Breaking News') }}</h6>
                </div>
            </div>
            <div class="col-md-9 col-xl-10">
                <div class="maan-slide-text">


{{--start dynamic breaking news include --}}

                    @include('frontend.layouts._dynamic_breakingnews')

{{--end dynamic breaking news include --}}


                </div>
            </div>
        </div>
    </div>

