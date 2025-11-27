@extends('admin.master')

@section('main_content')
    <style>
        .maantable img{
            height: 80px;
            width: 80px;
        }
        .maantable iframe,.embed-responsive{

            width: 100%;

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
                        <h1>{{ __('Video Gallery') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('Media Manage') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('Video Gallery') }}</li>
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
                                    <h3 class="card-title">{{ __('Gallery List') }}</h3>
                                </div>
                                <div class="col-2 ">

                                    @if(Auth::user()->permissions->contains('slug','create'))
                                    <a href="{{route('admin.videogallery.create')}}" class="btn btn-sm btn-success float-right mb-3" ><span class="fas fa-plus"></span>
                                        {{ __('Add Gallery') }}
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
                                            <th>{{ __('Video') }}</th>
                                            <th>{{ __('Title') }}</th>
                                            <th>{{ __('Publish Status') }}</th>
                                            <th class="maanaction">{{ __('Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($videogalleries as $key=>$videogallery)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ( $videogallery->video_option =='Upload Video')
                                                        <div class="embed-responsive embed-responsive-16by9">
                                                            <video controls="true" class="embed-responsive-item">
                                                                <source src="{{ asset($videogallery->video) }}" type="video/mp4" />
                                                            </video>
                                                        </div>
                                                    @else
                                                        <iframe src="{{ asset($videogallery->video) }}" allow="fullscreen" ></iframe>
                                                    @endif




                                                </td>
                                                <td>{{ $videogallery->title }}</td>
                                                <td><div class=" custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                        <input type="checkbox" class="custom-control-input status-item" name="status_{{$videogallery->id}}" id="status_{{$videogallery->id}}" data-id ="{{$videogallery->id}}" data-status-text="Video" @if($videogallery->status) checked @endif>
                                                        <label class="custom-control-label" for="status_{{$videogallery->id}}"></label>
                                                    </div>
                                                </td>

                                                <td class="maanaction">
                                                    <div class="row" id="maanaction-in">
                                                        {{--edit opiton--}}

                                                        @if(Auth::user()->permissions->contains('slug','edit'))
                                                        <a href="{{route('admin.videogallery.edit',$videogallery->id)}}"  class="edit-item" id="edit-item_{{$videogallery->id}}" >
                                                            <i class="fa fa-edit text-info"></i>
                                                        </a>
                                                        @endif
                                                        {{-- delete option--}}
                                                        @if(Auth::user()->permissions->contains('slug','delete'))

                                                        <form class="archiveItem" action="{{ route('admin.videogallery.destroy',$videogallery->id) }}" method="post" >
                                                            @csrf
                                                            @method('delete')
                                                            <a onclick="onSubmitDelete(this)"
                                                               id="{{$videogallery->id}}">
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
                                {{ $videogalleries->links() }}

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
