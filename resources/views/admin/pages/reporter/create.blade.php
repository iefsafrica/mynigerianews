@extends('admin.master')

@section('main_content')
    <style>
        #previewImg{
            height: 100px;
            width: 100px;
        }
    </style>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('admin.layouts._message')
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <!-- Content Header  Title -->
                        <h1>{{ __('Reporter') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('News Reporter') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('Reporter') }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header col-12 row ">

                                <div class="col-10">
                                    <h3 class="card-title">{{ __('New Reporter') }}</h3>
                                </div>
                                <div class="col-2 ">

                                    <a href="{{ route('admin.reporter') }}" class="btn btn-sm btn-outline-secondary float-right mb-3"><span class="fas fa-arrow-left"></span>
                                        {{ __('Back') }}
                                    </a>

                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- form start -->
                                <form method="POST" action="{{ route('admin.reporter') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">

                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputImage" >{{ __('Image') }}</label>
                                                <div class="col-sm-8 col-md-8">
                                                    <img id="previewImg" src="{{ asset('public/maan/images/user-icon.png')}}" alt="image">

                                                <p>
                                                    <input type="file" class="form-control" name="image" onchange="previewFile(this);" required>
                                                </p>
                                                </div>

                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputTitle">{{ __('First Name') }}</label>
                                                <div class="col-sm-8 col-md-8">
                                                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First name" value="{{old('first_name')}}" required>
                                                    @error('first_name')
                                                    <span class="text-danger">
                                                        {{$message}}
                                                    </span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputTitle">{{ __('Last Name') }}</label>
                                                <div class="col-sm-8 co-md-8">
                                                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last name" value="{{old('last_name')}}" required>
                                                    @error('last_name')
                                                    <span class="text-danger">
                                                    {{$message}}
                                                </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputEmail">{{ __('Email') }}</label>
                                                <div class="col-sm-8 co-md-8">
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="email" value="{{old('email')}}" required>
                                                    @error('email')
                                                    <span class="text-danger">
                                                        {{$message}}
                                                    </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputPhone">{{ __('Phone') }}</label>
                                                <div class="col-sm-8 co-md-8">
                                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="phone" value="{{old('phone')}}" required>
                                                    @error('phone')
                                                    <span class="text-danger">
                                                        {{$message}}
                                                    </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputNationalId">{{ __('National ID') }}</label>
                                                <div class="col-sm-8 co-md-8">
                                                    <input type="text" class="form-control" name="national_id" id="national_id" placeholder="national id" value="{{old('national_id')}}" required>
                                                    @error('national_id')
                                                    <span class="text-danger">
                                                        {{$message}}
                                                    </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputFatherName">{{ __('Father Name') }}</label>
                                                <div class="col-sm-8 co-md-8">
                                                    <input type="text" class="form-control" name="father_name" id="father_name" placeholder="Father name" value="{{old('father_name')}}" required>
                                                    @error('father_name')
                                                    <span class="text-danger">
                                                        {{$message}}
                                                    </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputMotherName">{{ __('Mother Name') }}</label>
                                                <div class="col-sm-8 co-md-8">
                                                    <input type="text" class="form-control" name="mother_name" id="mother_name" placeholder="Mother name" value="{{old('mother_name')}}" required>
                                                    @error('mother_name')
                                                    <span class="text-danger">
                                                        {{$message}}
                                                    </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputPresentAddress">{{ __('Present Address') }}</label>
                                                <div class="col-sm-8 co-md-8">
                                                    <textarea class="form-control" name="present_address" id="present_address"> {{old('present_address')}}

                                                    </textarea>
                                                    @error('present_address')
                                                    <span class="text-danger">
                                                        {{$message}}
                                                    </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputPermanentAddress">{{ __('Permanent Address') }}</label>
                                                <div class="col-sm-8 co-md-8">
                                                    <textarea class="form-control" name="permanent_address" id="permanent_address"> {{old('permanent_address')}}

                                                    </textarea>
                                                    @error('permanent_address')
                                                    <span class="text-danger">
                                                        {{$message}}
                                                    </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <!-- Date -->
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputAppointedDate">{{ __('Appointed Date') }}</label>
                                                <div class="col-sm-8 co-md-8">
                                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                        <input type="text" name="appointed_date" class="form-control datetimepicker-input" data-target="#reservationdate" />
                                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                    @error('appointed_date')
                                                    <span class="text-danger">
                                                        {{$message}}
                                                    </span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputPassword">{{ __('Password') }}</label>
                                                <div class="col-sm-8 co-md-8">
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="******" required>
                                                    @error('password')
                                                    <span class="text-danger">
                                                        {{$message}}
                                                    </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputMotherName">{{ __('Confirm Password') }}</label>
                                                <div class="col-sm-8 co-md-8">
                                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="******" required>
                                                    @error('password_confirmation')
                                                    <span class="text-danger">
                                                        {{$message}}
                                                    </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="name">{{ __('Role') }}</label>
                                                <div class="col-sm-8 co-md-8">
                                                    <select  class="form-control" name="role" id="role" required>
                                                        <option value="">{{ __('select type') }}</option>
                                                        @foreach($roles as $role)
                                                            <option data-role-id="{{$role->id}}"  value="{{$role->id}}">{{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group" id="permissions_box">
                                                <label for="name">{{ __('Permissions') }}</label>
                                                <div id="permissions_checkbox_list">

                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->

                                    </div>
                                    <div class="modal-footer justify-content-between">

                                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                    </div>
                                </form>

                            </div>

                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
