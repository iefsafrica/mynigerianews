@extends('admin.master')

@section('main_content')
    <style>
        .maanimage img{
            height: 100px;
            width: 100px;
            border-radius: 25px;
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
                        <h1>{{ __('User') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('News Users') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('User') }}</li>
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
                                    <h3 class="card-title">{{ __('User List') }}</h3>
                                </div>
                                <div class="col-2 ">
                                    @if(Auth::user()->permissions->contains('slug','create'))

                                    <a href="{{ route('admin.user.create') }}" class="btn btn-sm btn-success float-right mb-3"><span class="fas fa-plus"></span>
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
                                            <th>{{ __('Image') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Phone') }}</th>
                                            <th>{{ __('Role') }}</th>
                                            <th>{{ __('Permission') }}</th>
                                            <th class="maanaction">{{ __('Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($users as $key=>$user)
                                            @if(Auth::user()->user_type >= $user->user_type)
                                            <tr {{ Auth::user()->id ==$user->id ? 'bgcolor=#ddd' : '' }}>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="maanimage">
                                                    @if($user->image)
                                                        <img src="{{ asset($user->image) }} " alt="{{ $user->user_name }}">
                                                    @else
                                                        <img src="{{ asset('public/maan/images/user-icon.png') }} " alt="{{ $user->user_name }}">
                                                    @endif
                                                </td>
                                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                                <td>{{ $user->email }} </td>
                                                <td>{{ $user->phone }}</td>
                                                <td>
                                                    @if($user->roles->isNotEmpty())
                                                        @foreach($user->roles as $role)
                                                            <span class="badge badge-secondary">
                                                            {{ $role->name }}
                                                        </span>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>@if($user->permissions->isNotEmpty())
                                                        @foreach($user->permissions as $permission)
                                                            <span class="badge badge-secondary">
                                                            {{ $permission->name }}
                                                        </span>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td class="maanaction">
                                                    <div class="row" id="maanaction-in">
                                                        {{--edit opiton--}}
                                                        @if(Auth::user()->permissions->contains('slug','edit'))

                                                            @if($user->user_type==4 &&$user->id==1)

                                                            @else
                                                        <a href="{{ route('admin.user.edit',$user->id) }}"  class="edit-item"  >
                                                            <i class="fa fa-edit text-info"></i>
                                                        </a>
                                                                @endif
                                                        @endif
                                                        {{-- delete option --}}
                                                        @if(Auth::user()->permissions->contains('slug','delete'))

                                                            @if($user->user_type==4 &&$user->id==1)

                                                            @else
                                                        <form class="archiveItem" action="{{ route('admin.user.destroy',$user->id) }}" method="post" >
                                                            @csrf
                                                            @method('delete')
                                                            <a onclick="onSubmitDelete(this)"
                                                               id="{{$user->id}}">
                                                                <i class="fa fa-trash text-danger"></i>
                                                            </a>

                                                        </form>
                                                                @endif
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                {{ $users->links() }}

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
