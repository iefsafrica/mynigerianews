@extends('admin.master')

@section('main_content')
    <style>
        .maantable img{
            height: 80px;
            width: 80px;
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
                            <li class="breadcrumb-item active">{{ __('Photo Gallery') }}</li>
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
                                    <h3 class="card-title">{{ __('Gallery List') }}</h3>
                                </div>
                                <div class="col-2 ">
                                    @if(Auth::user()->permissions->contains('slug','create'))
                                    <button type="button" class="btn btn-sm btn-success float-right mb-3" data-toggle="modal" data-target="#modal-default"><span class="fas fa-plus"></span>
                                        {{ __('Add Gallery') }}
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
                                            <th>{{ __('Photo') }}</th>
                                            <th>{{ __('Title') }}</th>
                                            <th>{{ __('Publish Status') }}</th>
                                            <th class="maanaction">{{ __('Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($photogalleries as $key=>$photogallery)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <img src="{{ asset($photogallery->image) }}" alt="photo">
                                                </td>
                                                <td>{{ $photogallery->title }}</td>
                                                <td><div class=" custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                        <input type="checkbox" class="custom-control-input status-item" name="status_{{$photogallery->id}}" id="status_{{$photogallery->id}}"data-id ="{{$photogallery->id}}" data-status-text="Photo" @if($photogallery->status) checked @endif>
                                                        <label class="custom-control-label" for="status_{{$photogallery->id}}"></label>
                                                    </div>
                                                   </td>

                                                <td class="maanaction">
                                                    <div class="row" id="maanaction-in">
                                                        {{--edit opiton--}}
                                                        @if(Auth::user()->permissions->contains('slug','edit'))
                                                        <a href="{{route('admin.photogallery.edit',$photogallery->id)}}"  class="edit-item" id="edit-item_{{$photogallery->id}}" >
                                                            <i class="fa fa-edit text-info"></i>
                                                        </a>

                                                        @endif
                                                        {{-- delete option--}}
                                                        @if(Auth::user()->permissions->contains('slug','delete'))

                                                        <form class="archiveItem" action="{{ route('admin.photogallery.destroy',$photogallery->id) }}" method="post" >
                                                            @csrf
                                                            @method('delete')
                                                            <a onclick="onSubmitDelete(this)"
                                                               id="{{$photogallery->id}}">
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
                                {{ $photogalleries->links() }}

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
                    <h4 class="modal-title">{{ __('New Gallery') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form method="POST" action="{{ route('admin.photogallery') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputTitle">{{ __('Title') }}</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter name" value="{{old('title')}}" required>
                                @error('title')
                                <span class="text-danger">
                            {{$message}}
                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputDescription">{{ __('Description') }}</label>
                                <textarea class="form-control" name="description" id="description"  value="" required>{{old('description')}}</textarea>
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
                                    <input type="checkbox" class="custom-control-input" name="status" id="status">
                                    <label class="custom-control-label" for="status"></label>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-md-3 col-form-label" for="exampleInputImage" >{{ __('Image') }}</label>
                                <div class="col-sm-8 col-md-8">

                                        <input type="file" class="form-control" name="image[]" required multiple>

                                </div>

                            </div>

                        </div>
                        <!-- /.card-body -->

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary" id="submit">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection
