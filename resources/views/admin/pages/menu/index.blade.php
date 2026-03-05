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
                                    <h3 class="card-title">{{ __('Menu List') }}</h3>
                                </div>
                                <div class="col-2 ">
                                        <a href="{{ route('admin.menu.create') }}" class="btn btn-sm btn-success float-right mb-3"><span class="fas fa-plus"></span>
                                            {{ __('Add') }}
                                        </a>
                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered maantable">
                                        <thead>
                                        <tr>
                                            <th>{{ __('#') }}</th>
                                            <th>{{ __('Image') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Is_Active') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th class="maanaction">{{ __('Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($menus as $menu)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="list-image-rectangular">
                                                    @if($menu->image)
                                                        <img src="{{ asset($menu->image) }} " alt="{{ $menu->user_name }}">
                                                    @else
                                                        <img src="{{ asset('maan/images/user-icon.png') }} " alt="{{ $menu->user_name }}">
                                                    @endif
                                                </td>
                                                <td>{{ $menu->name }}</td>
                                                <td>
                                                    <div class=" custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                        <input type="checkbox" class="custom-control-input status-item" name="is_active_{{$menu->id}}" id="is_active_{{$menu->id}}" value="{{$menu->is_active}}"  {{$menu->is_active==1?'checked':''}} data-id-isactive ="{{$menu->id}}" data-status-text="Menu Active">
                                                        <label class="custom-control-label" for="is_active_{{$menu->id}}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class=" custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                        <input type="checkbox" class="custom-control-input status-item" name="status_{{$menu->id}}" id="status_{{$menu->id}}" value="{{$menu->status}}"  {{$menu->status==1?'checked':''}} data-id ="{{$menu->id}}" data-status-text="Menu">
                                                        <label class="custom-control-label" for="status_{{$menu->id}}"></label>
                                                    </div>
                                                </td>


                                                <td class="maanaction">
                                                    <div class="row" id="maanaction-in">
                                                        <a href="{{ route('admin.menu.edit',$menu->id) }}"  class="edit-item"  >
                                                            <i class="fa fa-edit text-info"></i>
                                                        </a>
                                                        <form class="archiveItem" action="{{ route('admin.menu.destroy',$menu->id) }}" method="post" >
                                                            @csrf
                                                            @method('delete')
                                                            <a onclick="onSubmitDelete(this)"
                                                               id="{{$menu->id}}">
                                                                <i class="fa fa-trash text-danger"></i>
                                                            </a>
                                                        </form>
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
                                {{ $menus->links() }}

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
