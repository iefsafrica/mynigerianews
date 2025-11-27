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
                        <h1>{{ __('Blog Sub-category') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('Blog Manage') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('Blog Sub-category') }}</li>
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
                                    <h3 class="card-title">{{ __('Sub-category List') }}</h3>
                                </div>
                                <div class="col-2 ">

                                    @if(Auth::user()->permissions->contains('slug','create'))
                                    <button type="button" class="btn btn-sm btn-success float-right mb-3" data-toggle="modal" data-target="#modal-default"><span class="fas fa-plus"></span>
                                        {{ __('Add Sub-category') }}
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
                                            <th>{{ __('Category') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th class="maanaction">{{ __('Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($subcategories as $key=>$subcategory)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $subcategory->blogCategory->name}}</td>
                                                <td>{{ $subcategory->name }}</td>

                                                <td class="maanaction">
                                                    <div class="row" id="maanaction-in">
                                                        {{--edit opiton--}}

                                                        @if(Auth::user()->permissions->contains('slug','edit'))
                                                        <a href=""  class="edit-item" id="edit-item_{{$subcategory->id}}" data-toggle="modal" data-target="#modal-edit" data-id ="{{$subcategory->id}}"  data-name ="{{$subcategory->name}}"data-category_id ="{{$subcategory->category_id}}" >
                                                            <i class="fa fa-edit text-info"></i>
                                                        </a>

                                                        @endif
                                                        {{-- delete option--}}
                                                        @if(Auth::user()->permissions->contains('slug','delete'))
                                                        <form class="archiveItem" action="{{ route('admin.blog.subcategory.destroy',$subcategory->id) }}" method="post" >
                                                            @csrf
                                                            @method('delete')
                                                            <a onclick="onSubmitDelete(this)"
                                                               id="{{$subcategory->id}}">
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
                                {{ $subcategories->links() }}

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
                    <h4 class="modal-title">{{ __('New Sub-category') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form method="POST" action="{{ route('admin.blog.subcategory') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ __('Name') }}</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="{{old('name')}}" required>
                                @error('name')
                                <span class="text-danger">
                            {{$message}}
                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ __('Category') }}</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    <option value="">select</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
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
                                <label for="exampleInputEmail1">{{ __('Category') }}</label>
                                <select class="form-control" name="category_id" id="edit_category_id">
                                    <option value="">select</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
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
    <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
    <script  type="text/javascript">
        $(document).ready(function (){
            $('.edit-item').each(function () {
                var container = $(this);
                var service = container.data('id');
                $('#edit-item_'+service).on('click',function () {
                    var categoryid = $('#edit-item_'+service).data('id');
                    var category_id = $('#edit-item_'+service).data('category_id');
                    var categoryname = $('#edit-item_'+service).data('name');
                    $('#edit_category_id').val(category_id);
                    $('#edit_name').val(categoryname);

                    var editactionroute = "{{ URL::to('admin/blog/subcategory/update') }}"
                    $('#editform').attr('action', editactionroute+'/'+categoryid);

                })


            });

        });

    </script>

@endsection
