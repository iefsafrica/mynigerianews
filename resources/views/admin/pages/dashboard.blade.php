@extends('admin.master')

@section('css_content')
    <style>
        /*
        * Maan|News dashboard custom css
        */

        #innerspan{
            font-size: 20px;
        }
        #revenue-chart{
            position: relative;
            height: 300px;
        }
        #revenue-chart-canvas{
            height: 300px;
        }
        #sales-chart{
            position: relative;
            height: 300px;
        }
        #sales-chart-canvas{
            height: 300px;
        }
        #world-map {
            height: 250px;
            width: 100%;
        }

    </style>

@endsection

@section('main_content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('Dashboard') }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('Dashboard ') }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>@if($admin){{ $admin }}@else{{ __('0') }}@endif</h3>

                                <p>{{ __('Admin') }}</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('admin.user') }}" class="small-box-footer">{{ __('More info') }} <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3> @if($publish_news) {{ $publish_news }} @else {{ __('0') }} @endif <sup id="innerspan">{{ __('') }}</sup></h3>

                                <p>{{ __('Publish Post') }}</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('admin.news') }}" class="small-box-footer">{{ __('More info') }} <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3> @if($unpublish_news){{ $unpublish_news }}@else{{ __('0') }}@endif</h3>

                                <p>{{ __('Unpublish Post') }}</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ route('admin.news') }}" class="small-box-footer">{{ __('More info') }} <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>@if($subscribe){{ $subscribe }}@else{{ __('0') }}@endif</h3>

                                <p>{{ __('Subscriber ') }}</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ route('admin.subscriber') }}" class="small-box-footer">{{ __('More info') }} <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>


@endsection

