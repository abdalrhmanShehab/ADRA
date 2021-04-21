@extends('layouts.admin_layout.admin_layout')

@section('title')
    Settings
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Admin Settings</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Update Password</h3>
        </div>
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
        <form method="post" action="{{route('admin.update.password')}}" name="updatePasswordForm" id="updatePasswordForm">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="emailAddress">Email address</label>
                    <input type="email" value="{{$admindetails->email}}" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="adminName">Name</label>
                    <input type="text" value="{{$admindetails->name}}"  class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="adminType">Type</label>
                    <input type="text" value="{{$admindetails->type}}"  class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="currentPassword">current password</label>
                    <input type="password" name="currentPassword" class="form-control" id="currentPassword" placeholder="Current password" required>
                    <span id="chkCurrentPwd"></span>
                </div>
                <div class="form-group">
                    <label for="newPassword">New password</label>
                    <input type="password" name="newPassword" class="form-control" id="newPassword" placeholder="New password" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm password</label>
                    <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" placeholder="Confirm password" required>
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
