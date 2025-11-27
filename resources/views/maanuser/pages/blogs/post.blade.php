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
                        <h1>{{ __('Blog') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('Blog Manage') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('Blog List') }}</li>
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
                                    <h3 class="card-title">{{ __('Blog List') }}</h3>
                                </div>
                                <div class="col-2 pull-right ">

                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <table class="table table-bordered maantable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('Summery') }}</th>
                                        <th>{{ __('Description') }}</th>
                                        <th>{{ __('Image') }}</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($postall as $post)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->summary }}</td>
                                            <td>{!! $post->description !!} </td>
                                            <td>
                                                @if ($post->image)
                                                    @php
                                                        $images = json_decode($post->image);
                                                    @endphp
                                                    @if($images!='')
                                                        @foreach ($images as $image)
                                                            @if (File::exists($image))

                                                                <img src="{{ asset($image) }}" alt="top-news">
                                                            @endif
                                                        @endforeach
                                                    @endif

                                                @endif

                                            </td>

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                {{ $postall->links() }}
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
