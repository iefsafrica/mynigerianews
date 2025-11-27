@extends('admin.master')

@section('css_content')
    <style>
        .maantable img{
            width: 150px;
        }
        .logo_footer{
            background-color: black;
        }
        .image-size-alert{
            font-size: 10px;
            margin-left: 10px;
            margin-right: 10px;
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
                        <h1>{{ __('Advertisement ') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('Advertisement') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('Ad Spaces') }}</li>
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
                                                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">{{ __('Ads Settings') }}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">{{ __(' Header code ') }}</a>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                                    <div class="card-header col-12 row">

                                                        <div class="col-10">
                                                            <h3 class="card-title">{{ __('Ad Spaces') }}</h3>
                                                        </div>
                                                        <div class="col-2 pull-right ">
                                                            @if(Auth::user()->permissions->contains('slug','create'))
                                                                <button type="button" class="btn btn-sm btn-success float-sm-right " data-toggle="modal" data-target="#modal-default"><span class="fas fa-plus"></span>
                                                                    {{ __('Add') }}
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
                                                                    <th>{{ __('Header Ads') }}</th>
                                                                    <th>{{ __('Sidebar Ads') }}</th>
                                                                    <th>{{ __('Before Ads') }}</th>
                                                                    <th>{{ __('After Ads') }}</th>
                                                                    <th class="maanaction">{{ __('Action') }}</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                                @foreach($advertisements as $advertisement)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>{!! $advertisement->header_ads !!} </td>
                                                                        <td>
                                                                            {!! $advertisement->sidebar_ads !!}
                                                                        </td>
                                                                        <td>{!! $advertisement->before_post_ads !!} </td>
                                                                        <td>{!! $advertisement->after_post_ads !!}</td>

                                                                         </td>
                                                                        <td class="maanaction">
                                                                            <div class="row" id="maanaction-in">
                                                                                {{--edit opiton--}}
                                                                                @if(Auth::user()->permissions->contains('slug','edit'))
                                                                                    <a href=""  class="edit-item" id="edit-item_{{$advertisement->id}}" data-toggle="modal" data-target="#modal-default-edit" data-id ="{{$advertisement->id}}"  data-header_ads ="{{$advertisement->header_ads}}"  data-sidebar_ads ="{{$advertisement->sidebar_ads}}"   data-before_post_ads ="{{$advertisement->before_post_ads}}"  data-after_post_ads ="{{$advertisement->after_post_ads}}"   >
                                                                                        <i class="fa fa-edit text-info"></i>
                                                                                    </a>
                                                                                @endif
                                                                                {{-- delete option--}}

                                                                                @if(Auth::user()->permissions->contains('slug','delete'))

                                                                                    <form class="archiveItem" action="{{ route('admin.ads.destroy',$advertisement->id) }}" method="post" >
                                                                                        @csrf
                                                                                        @method('delete')
                                                                                        <a onclick="onSubmitDelete(this)"
                                                                                           id="{{$advertisement->id}}">
                                                                                            <i class="fa fa-trash text-danger"></i>
                                                                                        </a>

                                                                                    </form>
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
                                                            <h3 class="card-title">{{ __(' Header code') }}</h3>
                                                        </div>
                                                        <div class="col-2 pull-right ">
                                                            @if(Auth::user()->permissions->contains('slug','create'))
                                                                <button type="button" class="btn btn-sm btn-success float-sm-right " data-toggle="modal" data-target="#modal-icon"><span class="fas fa-plus"></span>
                                                                    {{ __('Add') }}
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
                                                                    <th>{{ __(' Header Code') }}</th>
                                                                    <th>{{ __('Action') }}</th>

                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                            @foreach($googleanalytics as $googleanalytic)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>

                                                                    <td>{{  $googleanalytic->google_analytics }} </td>
                                                                    <td class="maanaction">
                                                                        <div class="row" id="maanaction-in">
                                                                            {{--edit opiton--}}
                                                                            @if(Auth::user()->permissions->contains('slug','edit'))
                                                                                <a href=""  class="edit-item-google" id="edit-item-google_{{$googleanalytic->id}}" data-toggle="modal" data-target="#modal-google-edit" data-google-id ="{{$googleanalytic->id}}"  data-google_analytics ="{{$googleanalytic->google_analytics}}"  >
                                                                                    <i class="fa fa-edit text-info"></i>
                                                                                </a>
                                                                            @endif
                                                                            {{-- delete option--}}

                                                                                @if(Auth::user()->permissions->contains('slug','delete'))

                                                                                    <form class="archiveItem" action="{{ route('admin.ads.googleanalytics.destroy',$googleanalytic->id) }}" method="post" >
                                                                                        @csrf
                                                                                        @method('delete')
                                                                                        <a onclick="onSubmitDelete(this)"
                                                                                           id="{{$googleanalytic->id}}">
                                                                                            <i class="fa fa-trash text-danger"></i>
                                                                                        </a>

                                                                                    </form>
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
                    <h4 class="modal-title">{{ __('Ads Create') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form method="POST" action="{{ route('admin.ads.store') }}"  enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="card-body">
                            <fieldset class="border p-2">
                                <legend class="w-auto"><span class="image-size-alert">{{ __('Header Ads ') }}</span></legend>
                            <div class="form-group">
                                <label for="adsurl">{{ __('Create Ad Code') }}</label>
                                <textarea class="form-control" name="header_ads" id="header_ads" cols="30" placeholder="ads">{{old('header_ads')}}</textarea>
                            </div>
                            </fieldset>
                                <fieldset class="border p-2">
                                    <legend class="w-auto"><span class="image-size-alert">{{ __('Sidebar Ads ') }}</span></legend>
                            <div class="form-group">
                                <label for="sidebar_ads">{{ __('Sidebar Ads') }}</label>
                                <textarea class="form-control" class="form-control" name="sidebar_ads" id="sidebar_ads" placeholder="ads" >{{old('sidebar_ads')}}</textarea>
                            </div>
                            </fieldset>
                            <fieldset class="border p-2">
                                <legend class="w-auto"><span class="image-size-alert">{{ __('Before Post Ads') }}</span></legend>
                            <div class="form-group">
                                <label for="before_post_ads">{{ __('Before Post Ads') }}</label>
                                <textarea class="form-control" name="before_post_ads" id="before_post_ads" cols="30" placeholder="ads">{{old('before_post_ads')}}</textarea>
                            </div>

                            </fieldset>
                            <fieldset class="border p-2">
                                <legend class="w-auto"><span class="image-size-alert">{{ __('After Post Ads') }}</span></legend>
                            <div class="form-group">
                                <label for="after_post_ads">{{ __('After Post Ads') }}</label>
                                <textarea class="form-control" name="after_post_ads" id="after_post_ads" cols="30" placeholder="ads">{{old('after_post_ads')}}</textarea>
                            </div>

                            </fieldset>


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
                    <h4 class="modal-title">{{ __('Edit Ads') }}</h4>
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
                            <fieldset class="border p-2">
                                <legend class="w-auto"><span class="image-size-alert">{{ __('Header Ads ') }}</span></legend>
                                <div class="form-group">
                                    <label for="adsurl">{{ __('Create Ad Code') }}</label>
                                    <textarea class="form-control" name="header_ads" id="edit_header_ads" cols="30" placeholder="ads">{{old('header_ads')}}</textarea>
                                </div>
                            </fieldset>
                            <fieldset class="border p-2">
                                <legend class="w-auto"><span class="image-size-alert">{{ __('Sidebar Ads ') }}</span></legend>
                                <div class="form-group">
                                    <label for="sidebar_ads">{{ __('Sidebar Ads') }}</label>
                                    <textarea class="form-control" class="form-control" name="sidebar_ads" id="edit_sidebar_ads" placeholder="ads" >{{old('sidebar_ads')}}</textarea>
                                </div>
                            </fieldset>
                            <fieldset class="border p-2">
                                <legend class="w-auto"><span class="image-size-alert">{{ __('Before Post Ads') }}</span></legend>
                                <div class="form-group">
                                    <label for="before_post_ads">{{ __('Before Post Ads') }}</label>
                                    <textarea class="form-control" name="before_post_ads" id="edit_before_post_ads" cols="30" placeholder="ads">{{old('before_post_ads')}}</textarea>
                                </div>

                            </fieldset>
                            <fieldset class="border p-2">
                                <legend class="w-auto"><span class="image-size-alert">{{ __('After Post Ads') }}</span></legend>
                                <div class="form-group">
                                    <label for="after_post_ads">{{ __('After Post Ads') }}</label>
                                    <textarea class="form-control" name="after_post_ads" id="edit_after_post_ads" cols="30" placeholder="ads">{{old('after_post_ads')}}</textarea>
                                </div>

                            </fieldset>


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
                    <h4 class="modal-title">{{ __(' Header code') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form method="POST" action="{{ route('admin.ads.googleanalytics.store') }}"  enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="card-body">


                            <div class="form-group">
                                <label for="contentimage">{{ __(' Header Code') }}</label>
                                <textarea class="form-control" name="google_analytics" id="google_analytics" placeholder=" header code " value="{{old('google_analytics')}}"></textarea>
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
    <!-- modal google edit-->
    <div class="modal fade" id="modal-google-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __(' Analytics code edit') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form id="editformnamegoogle" method="POST" action=""  enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="modal-body">

                        <div class="card-body">


                            <div class="form-group">
                                <label for="contentimage">{{ __(' Header code') }}</label>
                                <textarea class="form-control" name="google_analytics" id="edit_google_analytics" placeholder=" header code" value="{{old('google_analytics')}}"></textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- modal icon-->

@endsection
@section('js_content')
    <script  type="text/javascript">
        $(document).ready(function (){

            $('.edit-item').each(function () {
                var container = $(this);
                var service = container.data('id');
                $('#edit-item_'+service).on('click',function () {
                    var categoryid = $('#edit-item_'+service).data('id');

                    $('#edit_header_ads').val($('#edit-item_'+service).data('header_ads'));
                    $('#edit_sidebar_ads').val($('#edit-item_'+service).data('sidebar_ads'));
                    $('#edit_before_post_ads').val($('#edit-item_'+service).data('before_post_ads'));
                    $('#edit_after_post_ads').val($('#edit-item_'+service).data('after_post_ads'));


                    var editactionroute = "{{ URL::to('admin/ads/update') }}"
                    $('#editformname').attr('action', editactionroute+'/'+categoryid);

                })


            });
            $('.edit-item-google').each(function () {
                var container = $(this);
                var service = container.data('google-id');
                $('#edit-item-google_'+service).on('click',function () {
                    var googlecategoryid = $('#edit-item-google_'+service).data('google-id');
                    var googleanalytics = $('#edit-item-google_'+service).data('google_analytics');

                    $('#edit_google_analytics').val(googleanalytics);

                    var editactionroute = "{{ URL::to('admin/ads/googleanalytics/update') }}"
                    $('#editformnamegoogle').attr('action', editactionroute+'/'+googlecategoryid);

                })


            });

        });

    </script>
@endsection
