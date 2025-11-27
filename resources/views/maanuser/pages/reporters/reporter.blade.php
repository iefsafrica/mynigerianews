@extends('maanuser.master')

@section('css_content')
    <style>

        .maantable img{
            width: 100px;
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
                        <h1>{{ __('Reporter') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('Reporter Manage') }}</a></li>
                            <li class="breadcrumb-item active">{{ __(' Reporter') }}</li>
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

                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <table class="table table-bordered maantable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Phone') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Image') }}</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($reporters as $key=>$reporter)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $reporter->fisrt_name }} {{ $reporter->last_name }}</td>
                                            <td>{{ $reporter->phone }}</td>
                                            <td>{{ $reporter->email }}</td>
                                            <td><img src="{{ asset($reporter->image)  }}"></td>

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
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
