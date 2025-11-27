@extends('layouts.app')
@section('title')
    {{__('messages.settings')}}
@endsection

@section('content')
    <div class="container-fluid">
        @include('setting.setting_menu')
        <div class="card">

            <div class="card-body">
                {{ Form::open(['route' => 'setting.update','class'=>'form']) }}

                {{ Form::hidden('sectionName', $sectionName) }}
                <div class="row mt-5">
                    <div class="col-lg-4">
                        {{ Form::label('registration_system',__('messages.setting.registration_system').':',
                                     ['class'=>'form-label fs-6']) }}
                    </div>
                    <div class="col-lg-8">
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input w-30px h-20px is-active {{ auth()->user()->language == 'ar' ? 'float-none' : '' }}"
                                   name="registration_system" id="registrationSystem"
                                   type="checkbox" value="1"
                                    {{$setting['registration_system'] ? 'checked' : ''}} >
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-4">
                        {{ Form::label('emoji_system',__('messages.setting.emoji_system').':',
                                     ['class'=>'form-label fs-6']) }}
                    </div>
                    <div class="col-lg-8">
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input w-30px h-20px is-active {{ auth()->user()->language == 'ar' ? 'float-none' : '' }}"
                                   name="emoji_system" id="emojiSystem"
                                   type="checkbox" value="1"
                                    {{$setting['emoji_system'] ? 'checked' : ''}} >
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-start mt-5">
                    {{ Form::submit(__('messages.user.save_changes'),['class' => 'btn btn-primary']) }}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
