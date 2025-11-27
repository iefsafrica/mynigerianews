@extends('admin.master')

@section('main_content')
    <style>
        .maantable img{
            height: 100px;
            width: 100px;
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
                        <h1>{{ __('News') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('News Manage') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('News') }}</li>
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
                                    <h3 class="card-title">{{ __('Category List') }}</h3>
                                </div>
                                <div class="col-2 ">
                                    @if(Auth::user()->permissions->contains('slug','create'))
                                    <a href="{{ route('admin.news.create') }}" class="btn btn-sm btn-success float-right mb-3"><span class="fas fa-plus"></span>
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
                                            <th>{{ __('Title') }}</th>
                                            <th>{{ __('Summary') }}</th>
                                            <th>{{ __('Publish Status') }}</th>
                                            <th>{{ __('Breaking news') }}</th>
                                            <th class="maanaction">{{ __('Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($newsall as $key=>$news)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                @php
                                                $images = json_decode($news->image, true);
                                                @endphp

                                                <td>
                                                    @if($images !='')
                                                        @foreach($images as $image)
                                                            @if(File::exists($image))
                                                    <img src="{{ asset($image) }}" alt="news image">
                                                            @endif
                                                        @endforeach
                                                        @endif
                                                </td>
                                                <td>{{ $news->title }}</td>
                                                <td>{{ $news->summary }}</td>
                                                <td><div class=" custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                        <input type="checkbox" class="custom-control-input status-item" name="status_{{$news->id}}" id="status_{{$news->id}}" data-id ="{{$news->id}}" data-status-text="News" @if($news->status) checked @endif>
                                                        <label class="custom-control-label" for="status_{{$news->id}}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class=" custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                        <input type="checkbox" class="custom-control-input status-item" name="status_{{$news->id}}" id="breakingnews_{{$news->id}}" data-idbreaking ="{{$news->id}}" data-status-textbreaking="Breaking News" @if($news->breaking_news) checked @endif>
                                                        <label class="custom-control-label" for="breakingnews_{{$news->id}}"></label>
                                                    </div>
                                                </td>

                                                <td class="maanaction">
                                                    <div class="row" id="maanaction-in">
                                                        {{--edit opiton--}}
                                                        @if(Auth::user()->permissions->contains('slug','edit'))
                                                        <a href="{{ route('admin.news.edit',$news->id) }}"  class="edit-item" id="edit-item_{{$news->id}}" >
                                                            <i class="fa fa-edit text-info"></i>
                                                        </a>
                                                        @endif
                                                        {{-- delete option--}}
                                                        @if(Auth::user()->permissions->contains('slug','delete'))
                                                        <form class="archiveItem" action="{{ route('admin.news.destroy',$news->id) }}" method="post" >
                                                            @csrf
                                                            @method('delete')
                                                            <a onclick="onSubmitDelete(this)"
                                                               id="{{$news->id}}">
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
                                {{ $newsall->links() }}

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
