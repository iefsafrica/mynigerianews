@extends('admin.master')
@section('css_content')
    <style>
        .maantable img{
            width: 100px;
        }
        .size-alert{
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
                        <h1>{{ __('News Category') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('News Manage') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('News Category') }}</li>
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
                                    <h3 class="card-title">{{ __('Category List') }}</h3>
                                </div>
                                <div class="col-2 ">
                                    @if(Auth::user()->permissions->contains('slug','create'))
                                        <button type="button" class="btn btn-sm btn-success float-right mb-3" data-toggle="modal" data-target="#modal-default"><span class="fas fa-plus"></span>
                                            {{ __('Add Category') }}
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
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Slug') }}</th>
                                            <th>{{ __('Image') }}</th>
                                            <th>{{ __('Menu Publish') }}</th>
                                            <th class="maanaction">{{ __('Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($categories as $key=>$category)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->slug }}</td>
                                                <td><img src="{{ asset($category->image) }}"></td>
                                                <td>
                                                    <div class=" custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                        <input type="checkbox" class="custom-control-input status-item" name="menu_publish_{{$category->id}}" id="menu_publish_{{$category->id}}" data-id ="{{$category->id}}" data-status-text="News Category" @if($category->menu_publish) checked @endif>
                                                        <label class="custom-control-label" for="menu_publish_{{$category->id}}"></label>
                                                    </div>
                                                </td>
                                                <td class="maanaction">
                                                    <div class="row" id="maanaction-in">

                                                        {{--edit opiton--}}
                                                        @if(Auth::user()->permissions->contains('slug','edit'))
                                                            <a href=""  class="edit-item" id="edit-item_{{$category->id}}" data-toggle="modal" data-target="#modal-edit" data-id ="{{$category->id}}"  data-name ="{{$category->name}}" data-slug ="{{$category->slug}}" data-type ="{{$category->type}}" >
                                                                <i class="fa fa-edit text-info"></i>
                                                            </a>

                                                        @endif
                                                        {{-- delete option--}}
                                                        @if(Auth::user()->permissions->contains('slug','delete'))

                                                            <form class="archiveItem" action="{{ route('admin.news.category.destroy',$category->id) }}" method="post" >
                                                                @csrf
                                                                @method('delete')
                                                                <a onclick="onSubmitDelete(this)"
                                                                   id="{{$category->id}}">
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
                                {{ $categories->links() }}

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
                    <h4 class="modal-title">{{ __('New Category') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form method="POST" action="{{ route('admin.news.category') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="{{old('name')}}" required>
                                @error('name')
                                <span class="text-danger">
                            {{$message}}
                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ __('Slug') }}</label><span class="size-alert">{{ __('( slug must be english & lowercase )') }}</span>
                                <input type="text" class="form-control" name="slug" id="slug" placeholder="Enter slug" value="{{old('slug')}}" required>
                                @error('slug')
                                <span class="text-danger">
                            {{$message}}
                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image">{{ __('Image') }}</label> <span class="image-size-alert">{{ __('( image max size 270 x 141 )') }}</span>
                                <input type="file" class="form-control" name="image" id="image"  value="{{old('image')}}" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ __('Type') }}</label>
                                <select class="form-control" name="type" id="type">
                                    <option value="">{{ __('select') }}</option>
                                        <option value="{{__('home') }}">{{__('Home') }}</option>
                                        <option value="{{__('contact') }}">{{__('Contact') }}</option>
                                        <option value="{{__('news') }}">{{__('News') }}</option>
                                </select>
                                @error('type')
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
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- Edit modal -->
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Edit Category') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form  id="editform" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">

                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ __('Name') }}</label>
                                <input type="text" class="form-control" name="name" id="edit_name" placeholder="Enter name" value="{{old('name')}}" required>
                                @error('name')
                                <span class="text-danger">
                            {{$message}}
                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ __('Slug') }}</label><span class="size-alert">{{ __('( slug must be english & lowercase )') }}</span>
                                <input type="text" class="form-control" name="slug" id="edit_slug" placeholder="Enter slug" value="{{old('slug')}}" required>
                                @error('slug')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image">{{ __('Image') }}</label> <span class="image-size-alert">{{ __('( image max size 270 x 141 )') }}</span>
                                <input type="file" class="form-control" name="image" id="edit_image"  value="{{old('image')}}" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ __('Type') }}</label>
                                <select class="form-control" name="type" id="edit_type">
                                    <option value="">{{ __('select') }}</option>
                                    <option value="{{__('home') }}">{{__('Home') }}</option>
                                    <option value="{{__('contact') }}">{{__('Contact') }}</option>
                                    <option value="{{__('news') }}">{{__('News') }}</option>
                                </select>
                                @error('type')
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
                        <button type="submit" class="btn btn-success">{{ __('Update') }}</button>
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
                    var categoryid = $('#edit-item_'+service).data('id');
                    var categoryname = $('#edit-item_'+service).data('name');
                    var categoryslug = $('#edit-item_'+service).data('slug');
                    var categorytype = $('#edit-item_'+service).data('type');
                    $('#edit_name').val(categoryname);
                    $('#edit_slug').val(categoryslug);
                    $('#edit_type').val(categorytype);

                    var editactionroute = "{{ URL::to('admin/news/category/update') }}"
                    $('#editform').attr('action', editactionroute+'/'+categoryid);

                })


            });

        });

    </script>

@endsection
