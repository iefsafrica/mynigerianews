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
                        <h1>{{ __('Reporter') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('News Reporters') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('Reporter') }}</li>
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
                                    <h3 class="card-title">{{ __('Reporter List') }}</h3>
                                </div>
                                <div class="col-2 ">
                                    @if(Auth::user()->permissions->contains('slug','create'))
                                    <a href="{{ route('admin.reporter.create') }}" class="btn btn-sm btn-success float-right mb-3"><span class="fas fa-plus"></span>
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
                                            <th class="maanaction">{{ __('Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($reporters as $key=>$reporter)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="maanimage">
                                                    @if($reporter->image)
                                                    <img src="{{ asset($reporter->image) }} " alt="{{ $reporter->user_name }}">
                                                    @else
                                                        <img src="{{ asset('public/maan/images/user-icon.png') }} " alt="{{ $reporter->user_name }}">
                                                    @endif
                                                </td>
                                                <td>{{ $reporter->first_name }} {{ $reporter->last_name }}</td>
                                                <td>{{ $reporter->email }} </td>
                                                <td>{{ $reporter->phone }}</td>

                                                <td class="maanaction">
                                                    <div class="row" id="maanaction-in">
                                                        {{--edit opiton--}}
                                                        @if(Auth::user()->permissions->contains('slug','edit'))
                                                        <a href="{{ route('admin.reporter.edit',$reporter->id) }}"  class="edit-item"  >
                                                            <i class="fa fa-edit text-info"></i>
                                                        </a>

                                                        @endif
                                                        {{-- delete option--}}
                                                        @if(Auth::user()->permissions->contains('slug','delete'))

                                                        <form class="archiveItem" action="{{ route('admin.reporter.destroy',$reporter->id) }}" method="post" >
                                                            @csrf
                                                            @method('delete')
                                                            <a onclick="onSubmitDelete(this)"
                                                               id="{{$reporter->id}}">
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
                                {{ $reporters->links() }}

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
