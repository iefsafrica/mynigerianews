@extends('admin.master')

@section('main_content')
    <style>
        .editvideo{
            height: 100px;
            width: 120px;
        }
        .editimage{
            height: 100px;
            width: 120px;
        }
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
                        <h1>{{ __('video Gallery') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('Media Manage') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('video Gallery Edit') }}</li>
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
                                    <h3 class="card-title">{{ __('video Gallery Edit') }}</h3>
                                </div>


                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <!-- form start -->
                                <form method="POST" action="{{ route('admin.videogallery.update',$videogallery->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">

                                        <div class="card-body">

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">{{ __('Title') }}</label>
                                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter title" value="{{ $videogallery->title }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputDescription">{{ __('Description') }}</label>
                                                <textarea class="form-control" name="description" id="description"   required>{{old('description')}}{{ $videogallery->description }}</textarea>
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
                                                    <input type="checkbox" class="custom-control-input" name="status" id="status" @if($videogallery->status==1) checked @endif>
                                                    <label class="custom-control-label" for="status"></label>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label   for="publish">{{ __('Video Options') }}</label>
                                                <select class="form-control select2bs4" name="video_option" id="video_option" >
                                                    <option value="">{{__('Select')}}</option>
                                                    <option value="Upload Video" @if($videogallery->video_option=='Upload Video') selected @endif>{{ __('Upload Video') }}</option>
                                                    <option value="Share Link"  @if($videogallery->video_option=='Share Link') selected @endif>{{ __('Share Link') }}</option>
                                                </select>

                                            </div>
                                            <div class="form-group" id="videosorucediv">
                                                <label   for="ShareShite">{{ __('Sharing Site') }}</label>
                                                <select class="form-control select2bs4" name="video_source" id="video_source">
                                                    <option value="">{{__('Select')}}</option>
                                                    <option value="Youtube"@if($videogallery->video_source=='Youtube') selected @endif>{{ __('Youtube') }}</option>
                                                    <option value="Dailymotion"@if($videogallery->video_source=='Dailymotion') selected @endif>{{ __('Dailymotion') }}</option>
                                                </select>

                                            </div>
                                            <div class="form-group" id="linkdiv">
                                                <label   for="publish">{{ __('Link') }}</label>
                                                <input type="text" class="form-control" name="share_link" id="share_link" value="{{$videogallery->video}}">

                                            </div>

                                            <div class="form-group row" id="videodiv">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputVideo" >{{ __('Video') }}</label>
                                                @if ( $videogallery->video)
                                                    <iframe class="editvideo" src="{{ asset($videogallery->video) }}" frameborder="0" allowfullscreen></iframe>
                                                @else
                                                    <p>{{ __('No image found') }}</p>
                                                @endif
                                                <div class="col-sm-8 col-md-8">

                                                    <input type="file" class="form-control" name="video"  accept="video/*">

                                                </div>

                                            </div>
                                            <div class="form-group row" id="imagediv">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputVideo" >{{ __('Image') }}</label>
                                                @if ( $videogallery->image)
                                                    <img class="editimage" src="{{ asset($videogallery->image) }}" frameborder="0" allowfullscreen></img>
                                                @else
                                                    <p>{{ __('No image found') }}</p>
                                                @endif
                                                <div class="col-sm-8 col-md-8">

                                                    <input type="file" class="form-control" name="image" name="image">

                                                </div>

                                            </div>
                                        </div>
                                        <!-- /.card-body -->

                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <a  href="{{ route('admin.videogallery') }}" class="btn btn-sm btn-secondary float-sm-right "  ><span class="fas fa-arrow-left"></span>
                                            {{ __('back') }}
                                        </a>
                                        <button type="submit" class="btn btn-primary btn-sm" id="submit">{{ __('update') }}</button>
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
    <!-- modal -->


@endsection
