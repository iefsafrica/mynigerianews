@extends('layouts.auth')
@section('title')
    Forgot Password
@endsection
@section('content')
<div class="d-flex flex-column flex-column-fluid align-items-center justify-content-center p-0">
        <div class="col-12 text-center">
            <a href="/" class="image mb-7 mb-sm-10">
                <img alt="Logo" src="{{ getSettingValue()['logo'] }}" height="85px" width="85px">
            </a>
        </div>
        <div class="width-540">

            @include('flash::message')
            @include('layouts.errors')
        </div>
        <div class="bg-theme-white rounded-15 shadow-md width-540 px-5 px-sm-7 py-10 mx-auto">
            <div class="text-center">
                <h1 class="text-center mb-7">{{__('messages.forgot_password')}} ?</h1>
                <h3>
                    {{ __('auth.forgot_password.title') }}
                </h3>
                <div class="mb-4">
                    {{ __('messages.forgot_your_password_no_problem_just_let_us_know_your_email_address') }}
                </div>
            </div>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-sm-7 mb-4">
                    <label for="formInputEmail" class="form-label">
                        {{ __('messages.mails.email_address') }}:<span class="required"></span>
                    </label>
                    <input class="form-control" id="formInputEmail" aria-describedby="emailHelp" value="{{ old('email') }}"
                           type="email" placeholder="{{ __('messages.mails.email_address') }}" name="email" required autocomplete="off" autofocus>
                </div>
                
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary mx-3">{{ __('messages.email_password_reset_link') }}</button>
                    <a href="{{ route('login') }}" class="btn btn-secondary">{{ __('crud.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
    <!--end::Main-->
@endsection
@push('scripts')
@endpush
