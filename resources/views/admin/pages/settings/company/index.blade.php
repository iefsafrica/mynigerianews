@extends('admin.master')

@section('main_content')
    <style>
        .maantable img{
            height: 80px;
            width: 80px;
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
                        <h1>{{ __('Settings') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ __('Settings') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('Company Info') }}</li>
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
                                    <h3 class="card-title">{{ __('Company Info') }}</h3>
                                </div>
                                <div class="col-2 ">
                                    @if(Auth::user()->permissions->contains('slug','create'))
                                        <button type="button" class="btn btn-sm btn-success float-right mb-3" data-toggle="modal" data-target="#modal-default"><span class="fas fa-plus"></span>
                                            {{ __('Add Info') }}
                                        </button>
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
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Address Line 1') }}</th>
                                            <th>{{ __('Address Line 2') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Phone') }}</th>
                                            <th>{{ __('Message') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th class="maanaction">{{ __('Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($companies as $key=>$company)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $company->name }}</td>
                                                <td>{{ $company->address_line1 }}</td>
                                                <td>{{ $company->address_line2 }}</td>
                                                <td>{{ $company->email }}</td>
                                                <td>{{ $company->phone }}</td>
                                                <td>{{ $company->message }}</td>
                                                <td>
                                                    <div class=" custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                        <input type="checkbox" class="custom-control-input status-item" name="status_{{$company->id}}" id="contactus_{{$company->id}}" data-id ="{{$company->id}}" data-idcontactus ="{{$company->id}}" data-status-textcontactus="Contact Us" @if($company->status) checked @endif>
                                                        <label class="custom-control-label" for="contactus_{{$company->id}}"></label>
                                                    </div>
                                                </td>


                                                <td class="maanaction">
                                                    <div class="row" id="maanaction-in">
                                                        {{--edit opiton--}}
                                                        @if(Auth::user()->permissions->contains('slug','edit'))
                                                            <a href=""  class="edit-item" id="edit-item_{{$company->id}}"
                                                               data-toggle="modal" data-target="#modal-default-edit" data-id ="{{$company->id}}" data-name="{{$company->name}}" data-address_line1="{{$company->address_line1}}" data-address_line2="{{$company->address_line2}}" data-phone="{{$company->phone}}" data-email="{{$company->email}}" data-location_map="{{$company->location_map}}" data-message="{{$company->message}}" data-copyright="{{$company->copyright}}" data-version="{{$company->version}}">
                                                                <i class="fa fa-edit text-info"></i>
                                                            </a>

                                                        @endif
                                                        {{-- delete option--}}
                                                        @if(Auth::user()->permissions->contains('slug','delete'))

                                                            <form class="archiveItem" action="{{ route('admin.company.destroy',$company->id) }}" method="post" >
                                                                @csrf
                                                                @method('delete')
                                                                <a onclick="onSubmitDelete(this)"
                                                                   id="{{$company->id}}">
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
                                {{ $companies->links() }}

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
                    <h4 class="modal-title">{{ __('Company Info') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form method="POST" action="{{ route('admin.company.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputTitle">{{ __('Name') }}</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="{{old('name')}}" required>
                                @error('name')
                                <span class="text-danger">
                            {{$message}}
                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputTitle">{{ __('Address Line 1') }}</label>
                                <input type="text" class="form-control" name="address_line1" id="address_line1" placeholder="Enter address" value="{{old('address_line1')}}" required>
                                @error('address_line1')
                                <span class="text-danger">
                            {{$message}}
                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputTitle">{{ __('Address Line 2') }}</label>
                                <input type="text" class="form-control" name="address_line2" id="address_line2" placeholder="Enter address " value="{{old('address_line2')}}" >
                                @error('address_line2')
                                <span class="text-danger">
                            {{$message}}
                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputTitle">{{ __('Phone Number') }}</label>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter phone" value="{{old('phone')}}" required>
                                @error('phone')
                                <span class="text-danger">
                            {{$message}}
                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputTitle">{{ __('Email') }}</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Enter email" value="{{old('email')}}" required>
                                @error('email')
                                <span class="text-danger">
                            {{$message}}
                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputTitle">{{ __('location Map') }}</label>
                                <textarea class="form-control" name="location_map" id="location_map" placeholder="map url" >{{old('location_map')}}</textarea>
                                @error('location_map')
                                <span class="text-danger">
                            {{$message}}
                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputDescription">{{ __('Message') }}</label>
                                <textarea class="form-control" name="message" id="message" required>{{old('message')}}</textarea>

                                @error('message')
                                <span class="text-danger">
                            {{$message}}
                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputDescription">{{ __('Copyright') }}</label>
                                <textarea class="form-control" name="copyright" id="copyright" required>{{old('copyright')}}</textarea>

                                @error('copyright')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputDescription">{{ __('Version') }}</label>
                                <input class="form-control" name="version" id="version" required value="{{old('version')}}">

                                @error('version')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                                @enderror
                            </div>

                        </div>
                        <!-- /.card-body -->

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary" id="submint">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<!-- modal edit -->
    <div class="modal fade" id="modal-default-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Edit Company Info') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form id="editformname" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="modal-body">

                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputTitle">{{ __('Name') }}</label>
                                <input type="text" class="form-control" name="name" id="edit_name" placeholder="Enter name" value="{{old('name')}}" required>
                                @error('name')
                                <span class="text-danger">
                            {{$message}}
                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputTitle">{{ __('Address Line 1') }}</label>
                                <input type="text" class="form-control" name="address_line1" id="edit_address_line1" placeholder="Enter address" value="{{old('address_line1')}}" required>
                                @error('address_line1')
                                <span class="text-danger">
                            {{$message}}
                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputTitle">{{ __('Address Line 2') }}</label>
                                <input type="text" class="form-control" name="address_line2" id="edit_address_line2" placeholder="Enter address " value="{{old('address_line2')}}" >
                                @error('address_line2')
                                <span class="text-danger">
                            {{$message}}
                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputTitle">{{ __('Phone Number') }}</label>
                                <input type="text" class="form-control" name="phone" id="edit_phone" placeholder="Enter phone" value="{{old('phone')}}" required>
                                @error('phone')
                                <span class="text-danger">
                            {{$message}}
                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputTitle">{{ __('Email') }}</label>
                                <input type="text" class="form-control" name="email" id="edit_email" placeholder="Enter email" value="{{old('email')}}" required>
                                @error('email')
                                <span class="text-danger">
                            {{$message}}
                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputTitle">{{ __('location Map') }}</label>
                                <textarea class="form-control" name="location_map" id="edit_location_map" placeholder="map url" >{{old('location_map')}}</textarea>
                                @error('location_map')
                                <span class="text-danger">
                            {{$message}}
                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputDescription">{{ __('Message') }}</label>
                                <textarea class="form-control" name="message" id="edit_message"   required>{{old('message')}}</textarea>

                                @error('message')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputDescription">{{ __('Copyright') }}</label>
                                <textarea class="form-control" name="copyright" id="edit_copyright" required>{{old('copyright')}}</textarea>

                                @error('copyright')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputDescription">{{ __('Version') }}</label>
                                <input class="form-control" name="version" id="edit_version" required value="{{old('version')}}">

                                @error('version')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                                @enderror
                            </div>

                        </div>
                        <!-- /.card-body -->

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-success" id="submint">{{ __('Update') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection
@section('js_content')
    <script  type="text/javascript">
        $(document).ready(function (){

            $('.edit-item').each(function () {
                var container = $(this);
                var service = container.data('id');
                $('#edit-item_'+service).on('click',function () {
                    var companyid = $('#edit-item_'+service).data('id');
                    var companyname = $('#edit-item_'+service).data('name');
                    var companyaddress_line1 = $('#edit-item_'+service).data('address_line1');
                    var companyaddress_line2 = $('#edit-item_'+service).data('address_line2');
                    var companyphone = $('#edit-item_'+service).data('phone');
                    var companyemail = $('#edit-item_'+service).data('email');
                    var companylocation_map = $('#edit-item_'+service).data('location_map');
                    var companymessage = $('#edit-item_'+service).data('message');

                    $('#edit_name').val(companyname);
                    $('#edit_address_line1').val(companyaddress_line1);
                    $('#edit_address_line2').val(companyaddress_line2);
                    $('#edit_phone').val(companyphone);
                    $('#edit_email').val(companyemail);
                    $('#edit_location_map').val(companylocation_map);
                    $('#edit_message').val(companymessage);
                    $('#edit_copyright').val($('#edit-item_'+service).data('copyright'));
                    $('#edit_version').val($('#edit-item_'+service).data('version'));

                    var editactionroute = "{{ URL::to('admin/company/update') }}"
                    $('#editformname').attr('action', editactionroute+'/'+companyid);

                })


            });

        });

    </script>
@endsection
