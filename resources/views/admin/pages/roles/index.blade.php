@extends('admin.master')

@section('css_content')
    <style>
        .checkdiv input{
            margin-left:20px;
            margin-right:5px;
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
                        <h1>{{ __('Role') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('Role Manage') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('Role') }}</li>
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
                                    <h3 class="card-title">{{ __('Role List') }}</h3>
                                </div>
                                <div class="col-2 ">
                                    <button type="button" class="btn btn-sm btn-success float-right mb-3" data-toggle="modal" data-target="#modal-default"><span class="fas fa-plus"></span>
                                        {{ __('Add Role') }}
                                    </button>
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
                                            <th>{{ __('Permission') }}</th>
                                            <th class="maanaction">{{ __('Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($roles as $key=>$role)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td>{{ $role->slug }}</td>
                                                <td>
                                                    @foreach($role->permissions as $permission)
                                                        <span class="badge badge-secondary">
                                                        {{ $permission->name }}
                                                    </span>
                                                    @endforeach
                                                </td>

                                                <td class="maanaction">
                                                    <div class="row" id="maanaction-in">
                                                        @if($role->slug=='super-admin' && $loop->iteration==1)
                                                            {{__('Not Editable')}}
                                                        @else
                                                            {{--edit opiton--}}
                                                            @if(Auth::user()->permissions->contains('slug','edit'))
                                                                <a href="{{ route('admin.role.edit',$role->id) }}"  class="edit-item"  >
                                                                    <i class="fa fa-edit text-info"></i>
                                                                </a>
                                                            @endif
                                                            {{-- delete option--}}
                                                            @if(Auth::user()->permissions->contains('slug','delete'))

                                                                <form class="archiveItem" action="{{ route('admin.role.destroy',$role->id) }}" method="post" >
                                                                    @csrf
                                                                    @method('delete')
                                                                    <a onclick="onSubmitDelete(this)"
                                                                       id="{{$role->id}}">
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
                            <div class="card-footer clearfix">
                                {{ $roles->links() }}

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
                    <h4 class="modal-title">{{ __('New Role') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form method="POST" action="{{route('admin.role')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{ __('Name') }}</label>
                                <select class="form-control" name="name" id="name" required>
                                    <option value="">{{ __('Select') }}</option>
                                    <option value="Super Admin">{{ __('Super Admin') }}</option>
                                    <option value="Admin">{{ __('Admin') }}</option>
                                    <option value="Editor">{{ __('Editor') }}</option>
                                    <option value="Accountent">{{ __('Accountent') }}</option>
                                    <option value="Reporter">{{ __('Reporter') }}</option>
                                </select>
                            </div>
                            <div class="form-group checkdiv">
                                <label for="permission">{{ __('Permission') }}</label><br>
                                <input type="checkbox" name="permission[]" value="View"> {{ __('View') }}
                                <input type="checkbox" name="permission[]" value="Create"> {{ __('Create') }}
                                <input type="checkbox" name="permission[]" value="Edit"> {{ __('Edit') }}
                                <input type="checkbox" name="permission[]" value="Delete"> {{ __('Delete') }}
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

@endsection
