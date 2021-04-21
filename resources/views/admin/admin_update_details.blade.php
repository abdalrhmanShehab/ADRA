@extends('layouts.admin_layout.admin_layout')

@section('title')
    Details
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Update Admin Details</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Admin details</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Update Details</h3>
            </div>
            @if($errors->any())
                <br>
                <div class="alert alert-danger alert-dismissible fade-show" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(Session::has('error_message'))
                <br>
                <div class="alert alert-danger alert-dismissible fade-show" role="alert">
                    {{Session::get('error_message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(Session::has('success_message'))
                <br>
                <div class="alert alert-success alert-dismissible fade-show" role="alert">
                    {{Session::get('success_message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        @endif
        <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="{{route('post.updateAdminDetails')}}" enctype="multipart/form-data" name="updateAdminDetailsForm" id="updateAdminDetailsForm">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="admin_email">Email address</label>
                        <input type="email" name="admin_email" id="admin_email" value="{{$admindetails->email}}" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="admin_type">Type</label>
                        <input type="text" name="admin_type" id="admin_type" value="{{$admindetails->type}}" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="admin_name">Name</label>
                        <input type="text" name="admin_name" id="admin_name" value="{{$admindetails->name}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="admin_mobile">Mobile</label>
                        <input type="text" name="admin_mobile" id="admin_mobile" value="{{$admindetails->mobile}}" class="form-control" placeholder="Enter mobile number" required>
                    </div>
                    <div class="form-group">
                        <label for="admin_image">Image</label>
                        <input type="file" name="admin_image" id="admin_image" class="form-control" accept="image/*">
                        @if(!empty(auth()->guard('admin')->user()->image))
                            <br>
                            <a class="btn btn-info" target="_blank" href="{{url('images/admin_images/admin_photos/'.$admindetails->email.'/'.$admindetails->image)}}">View Image</a>
                            <input type="hidden" name="current_admin_image" value="{{empty(auth()->guard('admin')->user()->image)}}">
                        @endif
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>

    </div>
@endsection

@section('scripts')

    <script src="{{url('js/admin_js/admin_script.js')}}"></script>
@endsection
