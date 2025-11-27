@extends('maanuser.master')

@section('main_content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('Profile') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('User Profile') }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                         src="{{ asset('public/maan/images/user-icon.png') }}"
                                         alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">{{ $profile->first_name }} {{ $profile->last_name }}</h3>

                                <p class="text-muted text-center">{{ __('User') }}</p>

                                <ul class="list-group list-group-unbordered mb-3">

                                    <li class="list-group-item">
                                        <b>{{ __('Friends') }}</b> <a class="float-right">{{ __('13,287') }}</a>
                                    </li>
                                </ul>

                                <a href="#" class="btn btn-primary btn-block"><b>{{ __('Follow') }}</b></a>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->


                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">{{ __('Profile')}}</a></li>

                                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">{{ __('Contact') }}</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                        <!-- Post -->
                                        <div class="post">
                                            <div class="user-block">

                                                <span class="username">

                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                        </span>

                                            </div>
                                            <div class="card-body">

                                                <table class="table table-bordered maantable">
                                                    <tbody>
                                                    <tr>

                                                        <th>{{ __('First Name') }}</th><td>{{ $profile->first_name }}</td>
                                                    </tr>
                                                    <tr>

                                                        <th>{{ __('Last Name') }}</th><td>{{ $profile->last_name }}</td>
                                                    </tr>
                                                    <tr>

                                                        <th>{{ __('Mobile') }}</th><td>{{ $profile->mobile }}</td>
                                                    </tr>
                                                    <tr>

                                                        <th>{{ __('Email') }}</th><td>{{ $profile->email }}</td>
                                                    </tr>
                                                    </tbody>


                                                </table>
                                            </div>
                                        </div>
                                        <!-- /.post -->


                                    </div>
                                    <!-- /.tab-pane -->

                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


@endsection
