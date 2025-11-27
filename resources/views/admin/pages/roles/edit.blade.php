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
                            <li class="breadcrumb-item active">{{ __('Role edit') }}</li>
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
                                    <h3 class="card-title">{{ __('Role Edit') }}</h3>
                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <!-- form start -->
                                <form method="POST" action="{{ route('admin.role.update',$role->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="card-body">

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">{{ __('Name') }}</label>
                                                <select class="form-control" name="name" id="name" required>
                                                    <option value="">Select</option>
                                                    <option value="Supper Admin" @if($role->name=='Supper Admin') selected @endif >{{ __('Supper Admin') }}</option>
                                                    <option value="Admin" @if($role->name=='Admin') selected @endif >{{ __('Admin') }}</option>
                                                    <option value="Editor" @if($role->name=='Editor') selected @endif >{{ __('Editor') }}</option>
                                                    <option value="Accountent" @if($role->name=='Accountent') selected @endif >{{ __('Accountent') }}</option>
                                                    <option value="Reporter" @if($role->name=='Reporter')  selected @endif >{{ __('Reporter') }}</option>
                                                </select>
                                            </div>

                                            <div class="form-group checkdiv">
                                                <label for="permission">{{ __('Permission') }}</label><br>

                                                @foreach($role->permissions as $permission)
                                                    <input type="checkbox" name="permission[]" value="{{ $permission->name }}" @if($permission->name =="View"||$permission->name =="Create"||$permission->name =="Edit"||$permission->name =="Delete") checked @else '' @endif >
                                                    {{ $permission->name }}

                                                    @php
                                                        $data[] = $permission->name;
                                                    @endphp
                                                @endforeach
                                                @if(!in_array('View',$data))
                                                    <input type="checkbox" name="permission[]" value="View" > {{ __('View') }}
                                                @endif
                                                @if(!in_array('Create',$data))
                                                    <input type="checkbox" name="permission[]" value="Create" > {{ __('Create') }}
                                                @endif
                                                @if(!in_array('Edit',$data))
                                                    <input type="checkbox" name="permission[]" value="Edit" > {{ __('Edit') }}
                                                @endif
                                                @if(!in_array('Delete',$data))
                                                    <input type="checkbox" name="permission[]" value="Delete" > {{ __('Delete') }}
                                                @endif
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <a  href="{{ route('admin.role') }}" class="btn btn-sm btn-secondary float-sm-right "  ><span class="fas fa-arrow-left"></span>
                                            {{ __('back') }}
                                        </a>
                                        <button type="submit" class="btn btn-primary btn-sm">{{ __('update') }}</button>
                                    </div>
                                </form>

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

@endsection
