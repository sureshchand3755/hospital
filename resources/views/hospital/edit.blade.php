<?php $page="doctor";?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    @include('layout.partials.flash-message')
    <div class="content">
        <div class="row">
            <div class="col-sm-12">

                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ url('admin/hospital/update') }}" id="update_hospital" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-heading">
                                        <h4>Edit Hospital</h4>
                                    </div>
                                </div>
                                <input type="text" name="id" value="{{$data->id}}" style="display: none">
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="form-group local-forms">
                                        <label >Name <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" id="name" name="name"  placeholder="" value="{{ $data->name }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label >Email <span class="login-danger">*</span></label>
                                        <input class="form-control" type="email" id="email" name="email" placeholder="" value="{{ $data->email }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label >Password</label>
                                        <input class="form-control" type="password" placeholder="" id="password" name="password" >
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label >Confirm Password</label>
                                        <input class="form-control" type="password" placeholder="" id="cpassword" name="cpassword" >
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-top-form">
                                        <label class="local-top">Profile Image</label>
                                        <div class="settings-btn upload-files-avator">
                                            <input type="file" accept="image/*" name="profile_image" id="profile_image" onchange="loadFile(event)" class="hide-input">
                                            <label for="file" class="upload">Choose File</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group select-gender">
                                        <label class="gen-label">Status <span class="login-danger">*</span></label>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="status" id="status" class="form-check-input" value="0" {{ $data->status == 0 ? 'checked' : '' }}>Active
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" id="status" name="status" class="form-check-input" value="1" {{ $data->status == 1 ? 'checked' : ''}}>In Active
                                            </label>
                                        </div>
                                        <label id="status-error" class="error" for="status"></label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="doctor-submit text-center">
                                        <button type="submit" class="btn btn-primary submit-form me-2">Update</button>
                                        <button type="submit" class="btn btn-primary cancel-form" onclick="window.history.go(-1); return false;">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function($) {
    $("#update_hospital").validate({
            // Specify validation rules
            rules: {
                name: "required",
                email: "required",
                status: "required"
            },
            // Specify validation error messages
            messages: {
                name: "Please enter first name",
                email: "Please enter the email",
                status: "Please select status",
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
});
</script>
@endsection


