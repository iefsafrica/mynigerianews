@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{ getSettingValue()['logo'] }}" class="logo" width="120px" height="50px"
                 style="object-fit: cover"
                 alt="{{ getAppName() }}">
        @endcomponent
    @endslot
    <h2>Hello, </h2>
    This is Test Mail From {{ getAppName() }}
    <p style="margin-top: 15px">{{ __('messages.mails.thanks_regard') }}</p>
    <p>{{ getAppName() }}</p>
    @slot('footer')
        @component('mail::footer')
            <h6>© {{ date('Y') }} {{ getAppName() }}.</h6>
        @endcomponent
    @endslot
@endcomponent
