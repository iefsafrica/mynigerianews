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
                        <h1>{{ __('SEO Optimization') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('SEO Manage') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('SEO List') }}</li>
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
                                                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">{{ __('SEO Settings') }}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">{{ __('Sitemap') }}</a>
                                                </li>


                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                                    <div class="card-header col-12 row">

                                                        <div class="col-10">
                                                            <h3 class="card-title">{{ __('SEO Optimization') }}</h3>
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
                                                                    <th>{{ __('Keywords') }}</th>
                                                                    <th>{{ __('Author') }}</th>
                                                                    <th>{{ __('Meta Title') }}</th>
                                                                    <th>{{ __('Meta Description') }}</th>
                                                                    <th>{{ __('Google Analytics') }}</th>

                                                                    <th class="maanaction">{{ __('Action') }}</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                                @foreach($seooptimizations as $seooptimization)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>{{ $seooptimization->keywords }} </td>
                                                                        <td>{{ $seooptimization->author }} </td>
                                                                        <td>{{ $seooptimization->meta_title }} </td>
                                                                        <td>{{ $seooptimization->meta_description }} </td>
                                                                        <td>{{ $seooptimization->google_analytics }} </td>
                                                                        <td class="maanaction">
                                                                            <div class="row" id="maanaction-in">
                                                                                {{--edit opiton--}}
                                                                                @if(Auth::user()->permissions->contains('slug','edit'))
                                                                                    <a href=""  class="edit-item" id="edit-item_{{$seooptimization->id}}" data-toggle="modal" data-target="#modal-default-edit" data-id ="{{$seooptimization->id}}"  data-keywords ="{{$seooptimization->keywords}}"  data-author ="{{$seooptimization->author}}"   data-meta-title ="{{$seooptimization->meta_title}}" data-meta-description ="{{$seooptimization->meta_description}}" data-google-analytics ="{{$seooptimization->google_analytics}}"  >
                                                                                        <i class="fa fa-edit text-info"></i>
                                                                                    </a>
                                                                                @endif
                                                                                {{-- delete option--}}
                                                                                @if($loop->iteration>1)
                                                                                @if(Auth::user()->permissions->contains('slug','delete'))

                                                                                    <form class="archiveItem" action="{{ route('admin.settings.destroy',$seooptimization->id) }}" method="post" >
                                                                                        @csrf
                                                                                        @method('delete')
                                                                                        <a onclick="onSubmitDelete(this)"
                                                                                           id="{{$seooptimization->id}}">
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
                                                            <h3 class="card-title">{{ __('Sitemap') }}</h3>
                                                        </div>
                                                        <div class="col-2 pull-right ">
                                                            @if(Auth::user()->permissions->contains('slug','create'))
                                                                <a href="{{ route('admin.seo.sitemap') }}" class="btn btn-sm btn-success float-sm-right "><span class="fas fa-plus"></span>
                                                                    {{ __('Generate Sitemap') }}
                                                                </a>
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
                                                                    <th>{{ __('Sitemap') }}</th>

                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                                    <tr>
                                                                        <td>{{__('1') }}</td>

                                                                        <td ><a href="{{ asset('public/sitemap.xml') }}" download><i class="fa fa-download" aria-hidden="true"></i></a>  </td>

                                                                    </tr>


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
                    <h4 class="modal-title">{{ __('Create SEO') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form method="POST" action="{{ route('admin.seo.store') }}"  enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="card-body">

                            <div class="form-group">
                                <label for="keyword">{{ __('keywords') }}</label>
                                <textarea class="form-control" name="keywords" id="keywords" cols="30" placeholder="keywords,news">{{old('keywords')}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="contentimage">{{ __('Author') }}</label>
                                <input type="text" class="form-control" name="author" id="author" value="{{old('author')}}">
                            </div>
                            <div class="form-group">
                                <label for="contentimage">{{ __('Meta  Title') }}</label>
                                <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{old('meta_title')}}">
                            </div>
                            <div class="form-group">
                                <label for="contentimage">{{ __('Meta  Description') }}</label>
                                <textarea class="form-control" name="meta_description" id="meta_description" value="{{old('meta_description')}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="contentimage">{{ __('Google Analytics') }}</label>
                                <textarea class="form-control" name="google_analytics" id="google_analytics" value="{{old('google_analytics')}}"></textarea>
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
                    <h4 class="modal-title">{{ __('Edit SEO') }}</h4>
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
                                <label for="keyword">{{ __('keywords') }}</label>
                                <textarea class="form-control" name="keywords" id="edit_keywords" cols="30" placeholder="keywords,news">{{old('keywords')}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="contentimage">{{ __('Author') }}</label>
                                <input type="text" class="form-control" name="author" id="edit_author" value="{{old('author')}}">
                            </div>
                            <div class="form-group">
                                <label for="contentimage">{{ __('Meta  Title') }}</label>
                                <input type="text" class="form-control" name="meta_title" id="edit_meta_title" value="{{old('meta_title')}}">
                            </div>
                            <div class="form-group">
                                <label for="contentimage">{{ __('Meta  Description') }}</label>
                                <textarea class="form-control" name="meta_description" id="edit_meta_description" value="{{old('meta_description')}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="contentimage">{{ __('Google Analytics') }}</label>
                                <textarea class="form-control" name="google_analytics" id="edit_google_analytics" value="{{old('google_analytics')}}"></textarea>
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

@endsection
@section('js_content')
    <script  type="text/javascript">
        $(document).ready(function (){

            $('.edit-item').each(function () {
                var container = $(this);
                var service = container.data('id');
                $('#edit-item_'+service).on('click',function () {
                    var categoryid = $('#edit-item_'+service).data('id');
                    var seokeywords = $('#edit-item_'+service).data('keywords');
                    var seoauthor = $('#edit-item_'+service).data('author');
                    var seometatitle = $('#edit-item_'+service).data('meta-title');
                    var seometadescription = $('#edit-item_'+service).data('meta-description');
                    var seogoogleanalytics = $('#edit-item_'+service).data('google-analytics');
                    $('#edit_keywords').val(seokeywords);
                    $('#edit_author').val(seoauthor);
                    $('#edit_meta_title').val(seometatitle);
                    $('#edit_meta_description').val(seometadescription);
                    $('#edit_google_analytics').val(seogoogleanalytics);

                    var editactionroute = "{{ URL::to('admin/seo/update') }}"
                    $('#editformname').attr('action', editactionroute+'/'+categoryid);

                })


            });

        });

    </script>
@endsection
