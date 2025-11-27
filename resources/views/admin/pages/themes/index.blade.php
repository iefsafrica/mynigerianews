@extends('admin.master')

@section('main_content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('admin.layouts._message')
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <!-- Content Header  Title -->
                        <h1>{{ __('Theme Settings') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('Theme Manage') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('Theme Settings') }}</li>
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
                                    <h3 class="card-title">{{ __('Theme List') }}</h3>
                                </div>
                                {{--<div class="col-2 ">
                                    @if(Auth::user()->permissions->contains('slug','create'))
                                        <button type="button" class="btn btn-sm btn-success float-right mb-3" data-toggle="modal" data-target="#modal-default"><span class="fas fa-plus"></span>
                                            {{ __('Add') }}
                                        </button>
                                    @endif
                                </div>--}}


                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                    <div class="maan-news-theme-list-wrapper">
                                        @foreach($themes as $theme)
                                        <div class="maan-news-theme-items card">
                                                <div class="theme-img">
                                                    <img src="{{ asset($theme->image) }}" alt="theme-img">
                                                </div>
                                                <div class="card-body theme-discription-body">
                                                    <h3>{{$theme->title}}</h3>
                                                    <p>{{__('Author:')}} {{$theme->author}} </p>
                                                    <p>{{__('Version:')}} {{$theme->version}}</p>
                                                    <p>{{__('Description:')}} {{$theme->description}}</p>
                                                    @if($theme->is_active==1)
                                                        <button class="btn news-theme-btn status-item active-btn" id="theme_active_{{$theme->id}}" data-id ="{{$theme->id}}" data-is-active="{{$theme->is_active}}" data-status-text="Theme Active" disabled>{{__('Activated')}}</button>
                                                    @else
                                                        <button class="btn news-theme-btn status-item deactive-btn" id="theme_active_{{$theme->id}}" data-id ="{{$theme->id}}" data-is-active="{{$theme->is_active}}" data-status-text="Theme Active">{{__('Deactivated')}}</button>
                                                    @endif

                                                    <a href="" class="btn news-theme-btn btn-primary edit-item" id="edit-theme_{{$theme->id}}" data-toggle="modal" data-target="#modal-default" data-id ="{{$theme->id}}"  data-title ="{{$theme->title}}" data-author ="{{$theme->author}}" data-description ="{{$theme->description}}" data-page ="{{$theme->page}}" data-version ="{{$theme->version}}">{{__('Edit')}}</a>
                                                </div>
                                        </div>
                                        @endforeach

                                    </div>
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

    <!-- modal -->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('New Theme') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form name="themeForm" method="POST" action="{{ route('admin.theme.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">{{ __('Title') }}</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter title" value="{{old('title')}}" required>
                                @error('title')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">{{ __('Author') }}</label>
                                <input type="text" class="form-control" name="author" id="author" placeholder="Enter title" value="{{old('title')}}" required>
                                @error('title')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">{{ __('Description') }}</label>
                                <textarea  class="form-control" name="description" id="description">{{old('description')}}</textarea>
                                @error('description')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">{{ __('Version') }}</label>
                                <input type="text" class="form-control" name="version" id="version" placeholder="Enter version" value="{{old('version')}}" required>
                                @error('version')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="page">{{ __('Choose Home Page') }}</label>
                                <div>
                                    <select  class="form-control" name="page" id="page" required>
                                        <option value="">{{ __('select page') }}</option>
                                        <option value="Home 1" {{ "Home 1" == old('name') ? 'selected' : '' }}>{{__('Home 1')}}</option>
                                        <option value="Home 2" {{ "Home 2" == old('name') ? 'selected' : '' }}>{{__('Home 2')}}</option>
                                        <option value="Home 3" {{ "Home 3" == old('name') ? 'selected' : '' }}>{{__('Home 3')}}</option>
                                        <option value="Home 4" {{ "Home 4" == old('name') ? 'selected' : '' }}>{{__('Home 4')}}</option>
                                        <option value="Home 5" {{ "Home 5" == old('name') ? 'selected' : '' }}>{{__('Home 5')}}</option>
                                        <option value="Home 6" {{ "Home 6" == old('name') ? 'selected' : '' }}>{{__('Home 6')}}</option>
                                        <option value="Home 7" {{ "Home 7" == old('name') ? 'selected' : '' }}>{{__('Home 7')}}</option>
                                    </select>
                                </div>
                            </div>
                            @error('page')
                            <span class="text-danger">
                                    {{$message}}
                                </span>
                            @enderror

                            <div class="form-group">
                                <label for="image">{{ __('Image') }}</label> <span class="image-size-alert"></span>
                                <input type="file" class="form-control" name="image" id="image"  value="{{old('image')}}" >
                            </div>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


@endsection
