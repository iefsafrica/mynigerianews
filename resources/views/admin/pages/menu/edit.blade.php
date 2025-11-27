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
                        <h1>{{ __('Menu') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('Menu') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('Menu Setting') }}</li>
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
                                    <h3 class="card-title">{{ __('New Menu') }}</h3>
                                </div>
                                <div class="col-2 ">

                                    <a href="{{ route('admin.menu.index') }}" class="btn btn-sm btn-outline-secondary float-right mb-3"><span class="fas fa-arrow-left"></span>
                                        {{ __('Back') }}
                                    </a>

                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- form start -->
                                <form method="POST" action="{{ route('admin.menu.update',$menu->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputImage" >{{ __('Image') }}</label>
                                                <div class="col-sm-8 col-md-8">
                                                    <img id="previewImg" class="preview-image-rectangular" src="{{ asset($menu->image)}}" alt="image">
                                                    <p>
                                                        <input type="file" class="form-control" name="image" accept="image/*" onchange="previewFile(this);">
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-3 col-form-label" for="name">{{ __('Menu Name') }}</label>
                                                <div class="col-sm-8 co-md-8">
                                                    <select  class="form-control" name="name" id="name" required>
                                                        <option value="">{{ __('select menu') }}</option>
                                                        <option value="Menu 1" {{ "Menu 1" == $menu->name ? 'selected' : '' }}>{{__('Menu 1')}}</option>
                                                        <option value="Menu 2" {{ "Menu 2" == $menu->name ? 'selected' : '' }}>{{__('Menu 2')}}</option>
                                                        <option value="Menu 3" {{ "Menu 3" == $menu->name ? 'selected' : '' }}>{{__('Menu 3')}}</option>
                                                        <option value="Menu 4" {{ "Menu 4" == $menu->name ? 'selected' : '' }}>{{__('Menu 4')}}</option>
                                                        <option value="Menu 5" {{ "Menu 5" == $menu->name ? 'selected' : '' }}>{{__('Menu 5')}}</option>
                                                        <option value="Menu 6" {{ "Menu 6" == $menu->name ? 'selected' : '' }}>{{__('Menu 6')}}</option>
                                                        <option value="Menu 7" {{ "Menu 7" == $menu->name ? 'selected' : '' }}>{{__('Menu 7')}}</option>
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
