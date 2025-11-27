@extends('admin.master')

@section('main_content')
    <style>
        .maantable img{
            height: 80px;
            width: 80px;
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
                        <h1>{{ __('Social Share') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('Social Share') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('Social Info') }}</li>
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
                                    <h3 class="card-title">{{ __('Social Info') }}</h3>
                                </div>
                                <div class="col-2">
                                    @if( Auth::user()->permissions->contains('slug','create'))
                                        <button type="button" class="btn btn-sm btn-success float-right mb-3" data-toggle="modal" data-target="#modal-default"><span class="fas fa-plus"></span>
                                            {{ __('Add Info') }}
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
                                            <th>{{ __('URL') }}</th>
                                            <th>{{ __('Icon') }}</th>
                                            <th>{{ __('Followers') }}</th>

                                            <th class="maanaction">{{ __('Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($socials as $key=>$social)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $social->url }}</td>
                                                <td>{{ $social->icon_code }}</td>
                                                <td>{{ $social->follower }}</td>

                                                <td class="maanaction">
                                                    <div class="row" id="maanaction-in">
                                                        {{--edit opiton--}}
                                                        @if(Auth::user()->permissions->contains('slug','edit'))
                                                            <a href=""  class="edit-item" id="edit-item_{{$social->id}}"
                                                               data-toggle="modal" data-target="#modal-default-edit" data-id ="{{$social->id}}" data-url="{{$social->url}}" data-icon_code="{{$social->icon_code}}"
                                                               data-follower="{{$social->follower}}" >
                                                                <i class="fa fa-edit text-info"></i>
                                                            </a>

                                                        @endif
                                                        {{-- delete option--}}
                                                        @if(Auth::user()->permissions->contains('slug','delete'))

                                                            <form class="archiveItem" action="{{ route('admin.social.destroy',$social->id) }}" method="post" >
                                                                @csrf
                                                                @method('delete')
                                                                <a onclick="onSubmitDelete(this)"
                                                                   id="{{$social->id}}">
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
                            <div class="card-footer clearfix">
                                {{ $socials->links() }}

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
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Social Info') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form method="POST" action="{{ route('admin.social.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputTitle">{{ __('URL') }}</label>
                                <input type="text" class="form-control" name="url" id="url" placeholder="Enter url" value="{{old('url')}}" required>
                                @error('url')
                                <span class="text-danger">
                            {{$message}}
                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="icon_code">{{ __('Social Icon') }}</label>
                                <input type="text" class="form-control" name="icon_code" id="icon_code" placeholder="Enter icon" value="{{old('icon_code')}}" required>
                                @error('address_line1')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="follower">{{ __('Followers') }}</label>
                                <input type="number" class="form-control" name="follower" id="follower" placeholder="Enter follower" value="{{old('follower')}}" required>
                                @error('follower')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                                @enderror
                            </div>

                        </div>
                        <!-- /.card-body -->

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary" id="submint">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<!-- modal edit -->
    <div class="modal fade" id="modal-default-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Edit Company Info') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form id="editformname" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="modal-body">

                        <div class="card-body">
                            <div class="form-group">
                                <label for="edit_url">{{ __('URL') }}</label>
                                <input type="text" class="form-control" name="url" id="edit_url" placeholder="Enter url" value="{{old('url')}}" required>
                                @error('url')
                                <span class="text-danger">
                            {{$message}}
                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="edit_icon_code">{{ __('Social Icon') }}</label>
                                <input type="text" class="form-control" name="icon_code" id="edit_icon_code" placeholder="Enter icon" value="{{old('icon_code')}}" required>
                                @error('icon_code')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="edit_follower">{{ __('Flowers') }}</label>
                                <input type="number" class="form-control" name="follower" id="edit_follower" placeholder="Enter follower" value="{{old('follower')}}" required>
                                @error('follower')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                                @enderror
                            </div>


                        </div>
                        <!-- /.card-body -->

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-success" id="submint">{{ __('Update') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection
@section('js_content')
    <script  type="text/javascript">
        $(document).ready(function (){

            $('.edit-item').each(function () {
                var container = $(this);
                var service = container.data('id');
                $('#edit-item_'+service).on('click',function () {
                    var companyid = $('#edit-item_'+service).data('id');
                    var companyurl = $('#edit-item_'+service).data('url');
                    var companyicon_code = $('#edit-item_'+service).data('icon_code');


                    $('#edit_url').val(companyurl);
                    $('#edit_icon_code').val(companyicon_code);
                    $('#edit_follower').val($('#edit-item_'+service).data('follower'));


                    var editactionroute = "{{ URL::to('admin/social/update') }}"
                    $('#editformname').attr('action', editactionroute+'/'+companyid);

                })


            });

        });

    </script>
@endsection
