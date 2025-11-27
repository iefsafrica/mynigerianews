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
                        <h1>{{ __('Footer') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('Footer') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('Footer Setting') }}</li>
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
                                    <h3 class="card-title">{{ __('New Footer') }}</h3>
                                </div>
                                <div class="col-2 ">

                                    <a href="{{ route('admin.footer.index') }}" class="btn btn-sm btn-outline-secondary float-right mb-3"><span class="fas fa-arrow-left"></span>
                                        {{ __('Back') }}
                                    </a>

                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- form start -->
                                <form method="POST" action="{{ route('admin.footer.update',$footer->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputImage" >{{ __('Image') }}</label>
                                                <div class="col-sm-8 col-md-8">
                                                    <img id="previewImg" class="preview-image-rectangular" src="{{ asset($footer->image)}}" alt="image">
                                                    <p>
                                                        <input type="file" class="form-control" name="image" accept="image/*" onchange="previewFile(this);">
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="name">{{ __('Footer Name') }}</label>
                                                <div class="col-sm-8 co-md-8">
                                                    <select  class="form-control" name="name" id="name" required>
                                                        <option value="">{{ __('select footer') }}</option>
                                                        <option value="Footer 1" {{ "Footer 1" == $footer->name ? 'selected' : '' }}>{{__('Footer 1')}}</option>
                                                        <option value="Footer 2" {{ "Footer 2" == $footer->name ? 'selected' : '' }}>{{__('Footer 2')}}</option>
                                                        <option value="Footer 3" {{ "Footer 3" == $footer->name ? 'selected' : '' }}>{{__('Footer 3')}}</option>
                                                        <option value="Footer 4" {{ "Footer 4" == $footer->name ? 'selected' : '' }}>{{__('Footer 4')}}</option>
                                                        <option value="Footer 5" {{ "Footer 5" == $footer->name ? 'selected' : '' }}>{{__('Footer 5')}}</option>
                                                        <option value="Footer 6" {{ "Footer 6" == $footer->name ? 'selected' : '' }}>{{__('Footer 6')}}</option>
                                                        <option value="Footer 7" {{ "Footer 7" == $footer->name ? 'selected' : '' }}>{{__('Footer 7')}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer float-end">
                                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
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
