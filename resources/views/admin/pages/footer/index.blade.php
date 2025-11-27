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
                        <h1>{{ __('Footer') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('Footer') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('Footer Setting') }}</li>
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
                                    <h3 class="card-title">{{ __('Footer List') }}</h3>
                                </div>
                                <div class="col-2 ">
                                    <a href="{{ route('admin.footer.create') }}" class="btn btn-sm btn-success float-right mb-3"><span class="fas fa-plus"></span>
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
                                            <th>{{ __('Is Active') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th class="maanaction">{{ __('Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($footers as $footer)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="list-image-rectangular">
                                                    @if($footer->image)
                                                        <img src="{{ asset($footer->image) }} " alt="{{ $footer->user_name }}">
                                                    @else
                                                        <img src="{{ asset('public/maan/images/user-icon.png') }} " alt="{{ $footer->user_name }}">
                                                    @endif
                                                </td>
                                                <td>{{ $footer->name }}</td>
                                                <td>
                                                    <div class=" custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                        <input type="checkbox" class="custom-control-input status-item" name="is_active_{{$footer->id}}" id="is_active_{{$footer->id}}" value="{{$footer->is_active}}"  {{$footer->is_active==1?'checked':''}} data-id-isactive ="{{$footer->id}}" data-status-text="Footer Active">
                                                        <label class="custom-control-label" for="is_active_{{$footer->id}}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class=" custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                        <input type="checkbox" class="custom-control-input status-item" name="status_{{$footer->id}}" id="status_{{$footer->id}}" value="{{$footer->status}}" data-id ="{{$footer->id}}" data-status-text="Footer Status" {{$footer->status==1?'checked':''}}>
                                                        <label class="custom-control-label" for="status_{{$footer->id}}"></label>
                                                    </div>
                                                </td>


                                                <td class="maanaction">
                                                    <div class="row" id="maanaction-in">
                                                        <a href="{{ route('admin.footer.edit',$footer->id) }}"  class="edit-item"  >
                                                            <i class="fa fa-edit text-info"></i>
                                                        </a>
                                                        <form class="archiveItem" action="{{ route('admin.footer.destroy',$footer->id) }}" method="post" >
                                                            @csrf
                                                            @method('delete')
                                                            <a onclick="onSubmitDelete(this)"
                                                               id="{{$footer->id}}">
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
                                {{ $footers->links() }}

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
