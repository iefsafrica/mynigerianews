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
                                    <h3 class="card-title">{{ __('Blog List') }}</h3>
                                </div>
                                <div class="col-2 ">

                                    @if(Auth::user()->permissions->contains('slug','create'))
                                    <a href="{{ route('admin.blog.create') }}" class="btn btn-sm btn-success float-right mb-3"><span class="fas fa-plus"></span>
                                        {{ __('Add') }}
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
                                            <th>{{ __('Title') }}</th>
                                            <th>{{ __('Summary') }}</th>
                                            <th>{{ __('Publish Status') }}</th>

                                            <th class="maanaction">{{ __('Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($blogs as $key=>$blog)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $blog->title }}</td>
                                                <td>{{ $blog->summary }}</td>
                                                <td><div class=" custom-control custom-switch custom-switch-off-danger custom-switch-on-success ">
                                                        <input type="checkbox" class="custom-control-input status-item" name="status_{{$blog->id}}" id="status_{{$blog->id}}" data-id ="{{$blog->id}}" data-status-text="Blog" @if($blog->status) checked @endif >
                                                        <label class="custom-control-label" for="status_{{$blog->id}}"></label>
                                                    </div>
                                                </td>


                                                <td class="maanaction">
                                                    <div class="row" id="maanaction-in">
                                                        {{--edit opiton--}}
                                                        @if(Auth::user()->permissions->contains('slug','edit'))
                                                        <a href="{{ route('admin.blog.edit',$blog->id) }}"  class="edit-item" id="edit-item_{{$blog->id}}" >
                                                            <i class="fa fa-edit text-info"></i>
                                                        </a>
                                                        @endif
                                                        {{-- delete option--}}
                                                        @if(Auth::user()->permissions->contains('slug','delete'))

                                                        <form class="archiveItem" action="{{ route('admin.blog.destroy',$blog->id) }}" method="post" >
                                                            @csrf
                                                            @method('delete')
                                                            <a onclick="onSubmitDelete(this)"
                                                               id="{{$blog->id}}">
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
                                {{ $blogs->links() }}

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
