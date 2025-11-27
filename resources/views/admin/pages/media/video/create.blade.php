@extends('admin.master')

@section('main_content')
    <style>
        #count{
            color:green;
            font-weight:bold;
            font-size:15px;
            font-family:arial;
            background-color:#D4FCF6;
            padding-left:5px;
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
                        <h1>{{ __('Media') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('Media Manage') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('Video Gallery') }}</li>
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
                                    <h3 class="card-title">{{ __('Add Video') }}</h3>
                                </div>
                                <div class="col-2 ">

                                    <a href="{{ route('admin.videogallery') }}" class="btn btn-sm btn-outline-secondary float-right mb-3"><span class="fas fa-arrow-left"></span>
                                        {{ __('Back') }}
                                    </a>

                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- form start -->
                                <form method="POST" action="{{ route('admin.videogallery') }}"  enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputTitle">{{ __('Title') }}</label>
                                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter name" value="{{old('title')}}" required>
                                                @error('title')
                                                <span class="text-danger">
                            {{$message}}
                        </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputDescription">{{ __('Description') }}</label>
                                                <textarea class="form-control" name="description" id="description"  value="" required>{{old('description')}}</textarea>
                                                <div id="count">{{ __('Characters: 255') }} </div>
                                                @error('description')
                                                <span class="text-danger">
                            {{$message}}
                        </span>
                                                @enderror
                                            </div>
                                            <div class="form-group row">
                                                <label  class="col-md-6" for="publish">{{ __('Publish / Unpublish') }}</label>
                                                <div class="col-md-5 custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                    <input type="checkbox" class="custom-control-input" name="status" id="status">
                                                    <label class="custom-control-label" for="status"></label>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label   for="publish">{{ __('Video Options') }}</label>
                                                <select class="form-control select2bs4" name="video_option" id="video_option"  autocomplete="off">
                                                    <option value="">{{__('Select')}}</option>
                                                    <option value="Upload Video">{{ __('Upload Video') }}</option>
                                                    <option value="Share Link">{{ __('Share Link') }}</option>
                                                </select>

                                            </div>
                                            <div class="form-group" id="videosorucediv">
                                                <label   for="ShareShite">{{ __('Sharing Site') }}</label>
                                                <select class="form-control select2bs4" name="video_source" id="video_source">
                                                    <option value="">{{__('Select')}}</option>
                                                    <option value="Youtube">{{ __('Youtube') }}</option>
                                                    <option value="Dailymotion">{{ __('Dailymotion') }}</option>
                                                </select>

                                            </div>
                                            <div class="form-group" id="linkdiv">
                                                <label   for="publish">{{ __('Link') }}</label>
                                                <input type="text" class="form-control" name="share_link" id="share_link">

                                            </div>

                                            <div class="form-group row" id="videodiv">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputVideo" >{{ __('Video') }}</label>
                                                <div class="col-sm-8 col-md-8">

                                                    <input type="file" class="form-control" name="video"  accept="video/*">

                                                </div>

                                            </div>
                                            <div class="form-group row" id="imagediv">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputVideo" >{{ __('Image') }}</label>
                                                <div class="col-sm-8 col-md-8">

                                                    <input type="file" class="form-control" name="image" name="image">

                                                </div>

                                            </div>

                                        </div>
                                        <!-- /.card-body -->

                                    </div>
                                    <div class="modal-footer right-content-between">
                                        <button type="submit" class="btn btn-primary" id="submit">{{ __('Save') }}</button>
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

    <script>
        "use strict";
        // global app configuration object

        var config = {
            routes: {
                newscategory: "{{ URL::to('admin/news/create') }}"
            }
        };

    </script>
@endsection
