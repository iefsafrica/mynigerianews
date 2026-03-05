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
                        <h1>{{ __('Header') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('Header') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('Header Setting') }}</li>
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
                                    <h3 class="card-title">{{ __('Header List') }}</h3>
                                </div>
                                <div class="col-2 ">
                                    <a href="{{ route('admin.header.create') }}" class="btn btn-sm btn-success float-right mb-3"><span class="fas fa-plus"></span>
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

                                        @foreach($headers as $key=>$header)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="list-image-rectangular">
                                                    @if($header->image)
                                                        <img src="{{ asset($header->image) }} " alt="{{ $header->user_name }}">
                                                    @else
                                                        <img src="{{ asset('maan/images/user-icon.png') }} " alt="{{ $header->user_name }}">
                                                    @endif
                                                </td>
                                                <td>{{ $header->name }}</td>
                                                <td>
                                                    <div class=" custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                        <input type="checkbox" class="custom-control-input status-item" name="is_active_{{$header->id}}" id="is_active_{{$header->id}}" value="{{$header->is_active}}"  {{$header->is_active==1?'checked':''}} data-id-isactive ="{{$header->id}}" data-status-text="Header Active">
                                                        <label class="custom-control-label" for="is_active_{{$header->id}}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class=" custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                        <input type="checkbox" class="custom-control-input status-item" name="status_{{$header->id}}" id="status_{{$header->id}}" value="{{$header->status}}"  {{$header->status==1?'checked':''}} data-id ="{{$header->id}}" data-status-text="Header">
                                                        <label class="custom-control-label" for="status_{{$header->id}}"></label>
                                                    </div>
                                                </td>

                                                <td class="maanaction">
                                                    <div class="row" id="maanaction-in">
                                                        <a href="{{ route('admin.header.edit',$header->id) }}"  class="edit-item"  >
                                                            <i class="fa fa-edit text-info"></i>
                                                        </a>
                                                        <form class="archiveItem" action="{{ route('admin.header.destroy',$header->id) }}" method="post" >
                                                            @csrf
                                                            @method('delete')
                                                            <a onclick="onSubmitDelete(this)"
                                                               id="{{$header->id}}">
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
                                {{ $headers->links() }}

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
