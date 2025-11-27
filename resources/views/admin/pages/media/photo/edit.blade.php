@extends('admin.master')

@section('main_content')
    <style>
        .editimage{
            width: 100px;
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
                        <h1>{{ __('Photo Gallery') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('Media Manage') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('Photo Gallery Edit') }}</li>
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
                                    <h3 class="card-title">{{ __('Photo Gallery Edit') }}</h3>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <!-- form start -->
                                <form method="POST" action="{{ route('admin.photogallery.update',$photogallery->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">

                                        <div class="card-body">

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">{{ __('Title') }}</label>
                                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter title" value="{{ $photogallery->title }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputDescription">{{ __('Description') }}</label>
                                                <textarea class="form-control" name="description" id="description"   required>{{old('description')}}{{ $photogallery->description }}</textarea>
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
                                                    <input type="checkbox" class="custom-control-input" name="status" id="edit_status" @if($photogallery->status==1) checked @endif>
                                                    <label class="custom-control-label" for="edit_status"></label>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">{{ __('Image') }}</label>
                                                @if ( $photogallery->image)
                                                    <img src="{{ asset($photogallery->image) }}" class="editimage">
                                                @else
                                                    <p>{{ __('No image found') }}</p>
                                                @endif
                                                <input type="file" class="form-control" name="image" id="image" value="{{ $photogallery->image }}">
                                            </div>
                                        </div>
                                        <!-- /.card-body -->

                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <a  href="{{ route('admin.photogallery') }}" class="btn btn-sm btn-secondary float-sm-right "  ><span class="fas fa-arrow-left"></span>
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
