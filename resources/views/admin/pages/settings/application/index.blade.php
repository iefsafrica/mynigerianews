@extends('admin.master')

@section('css_content')
    <style>
        .maantable img{
            width: 100px;
        }
        .logo_footer{
            background-color: black;
        }
        .image-size-alert{
            font-size: 10px;
            margin-left: 10px;
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
                        <h1>{{ __('Settings') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('Settings Manage') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('Settings List') }}</li>
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

                            <!-- ./row -->
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="card card-primary card-tabs">
                                        <div class="card-header p-0 pt-1">
                                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">{{ __('App Name') }}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">{{ __('App Icon') }}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">{{ __('App Logo') }}</a>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                                    <div class="card-header col-12 row">

                                                        <div class="col-10">
                                                            <h3 class="card-title">{{ __('Settings List') }}</h3>
                                                        </div>
                                                        <div class="col-2 pull-right ">
                                                            @if(Auth::user()->permissions->contains('slug','create'))
                                                                <button type="button" class="btn btn-sm btn-success float-sm-right " data-toggle="modal" data-target="#modal-default"><span class="fas fa-plus"></span>
                                                                    {{ __('Add Name') }}
                                                                </button>
                                                            @endif
                                                        </div>

                                                    </div>
                                                    <!-- /.card-header -->
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered maantable">
                                                                <thead>
                                                                <tr>
                                                                    <th>{{ __('#') }}</th>
                                                                    <th>{{ __('Title') }}</th>
                                                                    <th>{{ __('Name') }}</th>
                                                                    <th>{{ __('short Name') }}</th>
                                                                    <th>{{ __('Footer Content') }}</th>
                                                                    <th>{{ __('Play Store URL') }}</th>
                                                                    <th>{{ __('App Store URL') }}</th>
                                                                    <th class="maanaction">{{ __('Action') }}</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                                @foreach($settings as $setting)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>{{ $setting->title }} </td>
                                                                        <td>{{ $setting->name }} </td>
                                                                        <td>{{ $setting->short_name }} </td>
                                                                        <td>{{ $setting->footer_content }} </td>
                                                                        <td>{{ $setting->play_store_url }} </td>
                                                                        <td>{{ $setting->app_store_url }} </td>
                                                                        <td class="maanaction">
                                                                            <div class="row" id="maanaction-in">
                                                                                {{--edit opiton--}}
                                                                                @if(Auth::user()->permissions->contains('slug','edit'))
                                                                                    <a href=""  class="edit-item" id="edit-item_{{$setting->id}}" data-toggle="modal" data-target="#modal-default-edit" data-id ="{{$setting->id}}"  data-title ="{{$setting->title}}"  data-name ="{{$setting->name}}"   data-short-name ="{{$setting->short_name}}" data-footer-content ="{{$setting->footer_content}}"data-play-store-url ="{{$setting->play_store_url}}"data-app-store-url ="{{$setting->app_store_url}}"  >
                                                                                        <i class="fa fa-edit text-info"></i>
                                                                                    </a>
                                                                                @endif
                                                                                {{-- delete option--}}
                                                                                @if($loop->iteration>1)
                                                                                @if(Auth::user()->permissions->contains('slug','delete'))

                                                                                    <form class="archiveItem" action="{{ route('admin.settings.destroy',$setting->id) }}" method="post" >
                                                                                        @csrf
                                                                                        @method('delete')
                                                                                        <a onclick="onSubmitDelete(this)"
                                                                                           id="{{$setting->id}}">
                                                                                            <i class="fa fa-trash text-danger"></i>
                                                                                        </a>

                                                                                    </form>
                                                                                @endif
                                                                                    @endif

                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach

                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                                    <div class="card-header col-12 row">

                                                        <div class="col-10">
                                                            <h3 class="card-title">{{ __('Settings List') }}</h3>
                                                        </div>
                                                        <div class="col-2 pull-right ">
                                                            @if(Auth::user()->permissions->contains('slug','create'))
                                                                <button type="button" class="btn btn-sm btn-success float-sm-right " data-toggle="modal" data-target="#modal-icon"><span class="fas fa-plus"></span>
                                                                    {{ __('Add Icon') }}
                                                                </button>
                                                            @endif
                                                        </div>

                                                    </div>
                                                    <!-- /.card-header -->
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered maantable">
                                                                <thead>
                                                                <tr>
                                                                    <th>{{ __('#') }}</th>
                                                                    <th>{{ __('Favicon') }}</th>
                                                                    <th>{{ __('Icon') }}</th>
                                                                    <th class="maanaction">{{ __('Action') }}</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                                @foreach($settings as $setting)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td><img src="{{ asset($setting->favicon) }}"  ></td>
                                                                        <td><img src="{{ asset($setting->icon) }}" ></td>
                                                                        <td class="maanaction">
                                                                            <div class="row" id="maanaction-in">
                                                                                {{--edit opiton--}}
                                                                                @if(Auth::user()->permissions->contains('slug','edit'))
                                                                                    <a href=""  class="edit-item"  id="edit-item-icon_{{$setting->id}}" data-toggle="modal" data-target="#modal-icon-edit" data-id ="{{$setting->id}}"  data-favicon ="{{$setting->favicon}}"  data-icon ="{{$setting->icon}}" >
                                                                                        <i class="fa fa-edit text-info"></i>
                                                                                    </a>
                                                                                @endif
                                                                                {{-- delete option--}}
                                                                                @if($loop->iteration>1)
                                                                                @if(Auth::user()->permissions->contains('slug','delete'))

                                                                                    <form class="archiveItem" action="{{ route('admin.setting.destroy',$setting->id) }}" method="post" >
                                                                                        @csrf
                                                                                        @method('delete')
                                                                                        <a onclick="onSubmitDelete(this)"
                                                                                           id="{{$setting->id}}">
                                                                                            <i class="fa fa-trash text-danger"></i>
                                                                                        </a>

                                                                                    </form>
                                                                                @endif
                                                                                    @endif

                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach

                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                                <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                                    <div class="card-header col-12 row">

                                                        <div class="col-10">
                                                            <h3 class="card-title">{{ __('Settings List') }}</h3>
                                                        </div>
                                                        <div class="col-2 pull-right ">
                                                            @if(Auth::user()->permissions->contains('slug','create'))
                                                                <button type="button" class="btn btn-sm btn-success float-sm-right " data-toggle="modal" data-target="#modal-logo"><span class="fas fa-plus"></span>
                                                                    {{ __('Add Logo') }}
                                                                </button>
                                                            @endif
                                                        </div>

                                                    </div>
                                                    <!-- /.card-header -->
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered maantable">
                                                                <thead>
                                                                <tr>
                                                                    <th>{{ __('#') }}</th>
                                                                    <th>{{ __('Logo') }}</th>
                                                                    <th>{{ __('Footer Logo') }}</th>
                                                                    <th class="maanaction">{{ __('Action') }}</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                                @foreach($settings as $setting)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td><img src="{{ asset($setting->logo) }}"  ></td>
                                                                        <td><img class="logo_footer" src="{{ asset($setting->logo_footer) }}"  ></td>
                                                                        <td class="maanaction">
                                                                            <div class="row" id="maanaction-in">
                                                                                {{--edit opiton--}}
                                                                                @if(Auth::user()->permissions->contains('slug','edit'))
                                                                                    <a href=""  class="edit-item"  id="edit-item-logo_{{$setting->id}}" data-toggle="modal" data-target="#modal-logo-edit" data-id ="{{$setting->id}}"  data-logo ="{{$setting->logo}}"  data-logo-footer ="{{$setting->logo_footer}}" >
                                                                                        <i class="fa fa-edit text-info"></i>
                                                                                    </a>
                                                                                @endif
                                                                                {{-- delete option--}}
                                                                                @if($loop->iteration>1)
                                                                                @if(Auth::user()->permissions->contains('slug','delete'))

                                                                                    <form class="archiveItem" action="{{ route('admin.setting.destroy',$setting->id) }}" method="post" >
                                                                                        @csrf
                                                                                        @method('delete')
                                                                                        <a onclick="onSubmitDelete(this)"
                                                                                           id="{{$setting->id}}">
                                                                                            <i class="fa fa-trash text-danger"></i>
                                                                                        </a>

                                                                                    </form>
                                                                                @endif
                                                                                    @endif

                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach

                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>

                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </div>
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
    <!-- modal name-->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Create Settings') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form method="POST" action="{{ route('admin.settings.store') }}"  enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="card-body">

                            <div class="form-group">
                                <label for="faviconicon">{{ __('Title') }}</label>
                                <input type="text" class="form-control" name="title" id="title"  value="{{old('title')}}" >
                            </div>

                            <div class="form-group">
                                <label for="contentimage">{{ __('Name') }}</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">
                            </div>
                            <div class="form-group">
                                <label for="contentimage">{{ __('Short Name') }}</label>
                                <input type="text" class="form-control" name="short_name" id="short_name" value="{{old('short_name')}}">
                            </div>
                            <div class="form-group">
                                <label for="contentimage">{{ __('Footer Content') }}</label>
                                <input type="text" class="form-control" name="footer_content" id="footer_content" value="{{old('footer_content')}}">
                            </div>
                            <div class="form-group">
                                <label for="edit_footer_content">{{ __('play Store URL') }}</label>
                                <input type="text" class="form-control" name="play_store_url" id="play_store_url" value="{{old('play_store_url')}}">
                            </div>
                            <div class="form-group">
                                <label for="edit_footer_content">{{ __('App Store URL') }}</label>
                                <input type="text" class="form-control" name="app_store_url" id="app_store_url" value="{{old('app_store_url')}}">
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
    </div><!-- modal name-->
    <!-- modal edit-->
    <div class="modal fade" id="modal-default-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Edit Settings') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form id="editformname" method="POST" action=""  enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="modal-body">

                        <div class="card-body">

                            <div class="form-group">
                                <label for="faviconicon">{{ __('Title') }}</label>
                                <input type="text" class="form-control" name="title" id="edit_title"  value="{{old('title')}}" >
                            </div>

                            <div class="form-group">
                                <label for="contentimage">{{ __('Name') }}</label>
                                <input type="text" class="form-control" name="name" id="edit_name" value="{{old('name')}}">
                            </div>
                            <div class="form-group">
                                <label for="contentimage">{{ __('Short Name') }}</label>
                                <input type="text" class="form-control" name="short_name" id="edit_short_name" value="{{old('short_name')}}">
                            </div>
                            <div class="form-group">
                                <label for="edit_footer_content">{{ __('Footer Content') }}</label>
                                <input type="text" class="form-control" name="footer_content" id="edit_footer_content" value="{{old('footer_content')}}">
                            </div>
                            <div class="form-group">
                                <label for="edit_footer_content">{{ __('play Store URL') }}</label>
                                <input type="text" class="form-control" name="play_store_url" id="edit_play_store_url" value="{{old('play_store_url')}}">
                            </div>
                            <div class="form-group">
                                <label for="edit_footer_content">{{ __('App Store URL') }}</label>
                                <input type="text" class="form-control" name="app_store_url" id="edit_app_store_url" value="{{old('app_store_url')}}">
                            </div>

                        </div>
                        <!-- /.card-body -->

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div><!-- modal name-->
    <!-- modal icon-->
    <div class="modal fade" id="modal-icon">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('New Icon') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form method="POST" action="{{ route('admin.settings.store') }}"  enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="card-body">

                            <div class="form-group">
                                <label for="faviconicon">{{ __('Favicon') }}</label> <span class="image-size-alert">{{ __('( favicon max size 50 x 50 )') }}</span>
                                <input type="file" class="form-control" name="favicon" id="favicon"  value="{{old('image')}}" >
                            </div>

                            <div class="form-group">
                                <label for="contentimage">{{ __('Icon') }}</label> <span class="image-size-alert">{{ __('( icon max size 100 x 80 )') }}</span>
                                <input type="file" class="form-control" name="icon" id="icon" >
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
    <!-- modal icon-->
    <!-- modal icon edit-->
    <div class="modal fade" id="modal-icon-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Edit Icon') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form id="editformicon" method="POST" action=""  enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="modal-body">

                        <div class="card-body">

                            <div class="form-group">
                                <label for="faviconicon">{{ __('Favicon') }}</label> <span class="image-size-alert">{{ __('( favicon max size 50 x 50 )') }}</span>

                                <input type="file" class="form-control" name="favicon" id="edit_favicon"  value="{{old('favicon')}}" >
                            </div>

                            <div class="form-group">
                                <label for="contentimage">{{ __('Icon') }}</label> <span class="image-size-alert">{{ __('( icon max size 100 x 80 )') }}</span>
                                <input type="file" class="form-control" name="icon" id="edit_icon" value="{{old('icon')}}">
                            </div>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('update') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- modal icon edit-->
    <!-- modal logo-->
    <div class="modal fade" id="modal-logo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('New Logo') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form method="POST" action="{{ route('admin.settings.store') }}"  enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="card-body">

                            <div class="form-group">
                                <label for="logo">{{ __('Logo') }}</label> <span class="image-size-alert">{{ __('( logo max size 200 x 200 )') }}</span>
                                <input type="file" class="form-control" name="logo" id="edit_logo"  value="{{old('image')}}" >
                            </div>

                            <div class="form-group">
                                <label for="footerlogo">{{ __('Footer Logo') }}</label> <span class="image-size-alert">{{ __('( footer logo max size 200 x 200 )') }}</span>
                                <input type="file" class="form-control" name="logo_footer" id="edit_logo_footer" >
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
    <!-- modal logo edit-->
    <div class="modal fade" id="modal-logo-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('edit Logo') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form id="editformlogo" method="POST" action=""  enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="modal-body">

                        <div class="card-body">

                            <div class="form-group">
                                <label for="logo">{{ __('Logo') }}</label> <span class="image-size-alert">{{ __('(logo max size 200 x 200 )') }}</span>
                                <input type="file" class="form-control" name="logo" id="logo"  value="{{old('image')}}" >
                            </div>

                            <div class="form-group">
                                <label for="footerlogo">{{ __('Footer Logo') }}</label> <span class="image-size-alert">{{ __('( footer logo max size 200 x 200 )') }}</span>
                                <input type="file" class="form-control" name="logo_footer" id="logo_footer" >
                            </div>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


@endsection
