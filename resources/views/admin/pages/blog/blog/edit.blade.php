@extends('admin.master')

@section('main_content')
    <style>
        .editimage{
            width: 50px;
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
                        <h1>{{ __('Blog') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('Blog Manage') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('Blog') }}</li>
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
                                    <h3 class="card-title">{{ __('Add Blog') }}</h3>
                                </div>
                                <div class="col-2 ">

                                    <a href="{{ route('admin.blog') }}" class="btn btn-sm btn-outline-secondary float-right mb-3"><span class="fas fa-arrow-left"></span>
                                        {{ __('Back') }}
                                    </a>

                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- form start -->
                                <form method="POST" action="{{ route('admin.blog.update',$blog->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputTitle">{{ __('Title') }}</label>
                                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter title" value="{{$blog->title}}" required>
                                                @error('title')
                                                <span class="text-danger">
                            {{$message}}
                        </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputSummary">{{ __('Summary') }}</label>
                                                <textarea class="form-control" name="summary" id="summary">{{$blog->summary}}</textarea>
                                                @error('summary')
                                                <span class="text-danger">
                                                {{$message}}
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputDescription">{{ __('Description') }}</label>

                                                <textarea class="form-group" name="description" id="summernote">
                                            {{$blog->description}}
                                          </textarea>


                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputDescription">{{ __('Blog Category') }}</label>

                                                <select class="form-control select2bs4" name="categgory_id" id="blogcategory_id">
                                                    <option value="">{{ __('select') }}</option>
                                                    @foreach($blogcategories as $blogcategory)
                                                        <option value="{{ $blogcategory->id }}" @if($blogcategory->id==$blogcategoryid) selected @endif>{{ $blogcategory->name }}</option>
                                                    @endforeach
                                                </select>


                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputDescription">{{ __('Blog Sub-category') }}</label>

                                                <select class="form-control select2bs4" name="subcategory_id" id="blogsubcategory_id">
                                                    @foreach($blogsubcategories as $blogsubcategory)
                                                        <option value="{{ $blogsubcategory->id }}" @if($blogsubcategory->id==$blog->blogsubcategory_id) selected @endif>{{ $blogsubcategory->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!-- Date -->
                                            <div class="form-group">
                                                <label for="exampleInputDate">{{ __('Date:') }}</label>
                                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="reservationdate" name="date" value="{{  date('m-d-Y', strtotime($blog->date)) }}"/>
                                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputDescription">{{ __('Tags') }}</label>

                                                <input type="text" class="form-control" name="tags" id="tags" placeholder="tags" value="{{$blog->tags}}">

                                            </div>


                                            <div class="form-group row">
                                                <label  class="col-md-3" for="publish">{{ __('Publish / Unpublish') }}</label>
                                                <div class="col-md-6 custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                    <input type="checkbox" class="custom-control-input" name="status" id="status" @if($blog->status==1) checked @endif>
                                                    <label class="custom-control-label" for="status"></label>
                                                </div>



                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputImage">{{ __('Image') }}</label>
                                                @if ($blog->image)
                                                    @php
                                                        $images = json_decode($blog->image);
                                                    @endphp
                                                    @if($images!='')
                                                        @foreach ($images as $image)
                                                            @if (File::exists($image))

                                                                <img src="{{ asset($image) }}" class="editimage">
                                                            @endif
                                                        @endforeach
                                                    @endif

                                                @else
                                                    <p>{{ __('No image found') }}</p>
                                                @endif
                                                <input type="file" name="image[]" id="image" multiple>
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

    <script>
        "use strict";
        // global app configuration object

        var config = {
            routes: {
                blogcategory: "{{ URL::to('admin/blog/edit') }}"
            }
        };


    </script>
@endsection
