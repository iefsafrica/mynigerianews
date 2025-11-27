@extends('admin.master')
@section('css_content')
    <style>
        .maantable img{
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
@endsection

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
                                <form method="POST" action="{{ route('admin.blog') }}"  enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">

                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputTitle">{{ __('Title') }}</label>
                                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter title" value="{{old('title')}}" required>
                                                @error('title')
                                                <span class="text-danger">
                            {{$message}}
                        </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputSummary">{{ __('Summary') }}</label>
                                                <textarea class="form-control" name="summary" id="summary_blog">{{old('summary')}}</textarea>
                                                @error('summary')
                                                <span class="text-danger">
                                                {{$message}}
                                                </span>
                                                @enderror
                                                <div id="count">{{ __('Characters: 255') }} </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputDescription">{{ __('Description') }}</label>

                                                <textarea class="form-group" name="description" id="summernote">
                                            {{old('description')}}
                                          </textarea>


                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputDescription">{{ __('Blog Category') }}</label>

                                                <select class="form-control select2bs4" name="category_id" id="blogcategory_id">
                                                    <option value="">{{ __('select') }}</option>
                                                    @foreach($blogcategories as $blogcategory)
                                                        <option value="{{ $blogcategory->id }}">{{ $blogcategory->name }}</option>
                                                    @endforeach
                                                </select>


                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputDescription">{{ __('Blog Sub-category') }}</label>

                                                <select class="form-control select2bs4" name="subcategory_id" id="blogsubcategory_id">
                                                    <option>{{__('select')}}</option>
                                                </select>
                                            </div>
                                            <!-- Date -->
                                            <div class="form-group">
                                                <label for="exampleInputDate">{{ __('Date:') }}</label>
                                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="date"/>
                                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputDescription">{{ __('Tags') }}</label>

                                                <input type="text" class="form-control" name="tags" id="tags" placeholder="tags">

                                            </div>


                                            <div class="form-group row">
                                                <label  class="col-md-3" for="publish">{{ __('Publish / Unpublish') }}</label>
                                                <div class="col-md-6 custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                    <input type="checkbox" class="custom-control-input" name="status" id="status">
                                                    <label class="custom-control-label" for="status"></label>
                                                </div>



                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputImage">{{ __('Image') }}</label>
                                                <input type="file" name="image[]" id="image" multiple>
                                            </div>

                                        </div>
                                        <!-- /.card-body -->

                                    </div>
                                    <div class="modal-footer justify-content-between">

                                        <button type="submit" class="btn btn-primary"  id="submit" >{{ __('Save') }}</button>
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
                blogcategory: "{{ URL::to('admin/blog/create') }}"
            }
        };


    </script>
@endsection
