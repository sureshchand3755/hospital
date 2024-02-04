<?php $page="doctor";?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-12">

                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ (Auth::user()->type==2)?route('hospital.reception.store'):route('admin.reception.store') }}" id="add_reception" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-heading">
                                        <h4>Add Receptionist</h4>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="form-group local-forms">
                                        <label >Name <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" id="name" name="name"  placeholder="" >
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label >Email <span class="login-danger">*</span></label>
                                        <input class="form-control" type="email" id="email" name="email" placeholder="" >
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label >Mobile <span class="login-danger">*</span></label>
                                        <input class="form-control" type="mobile" id="mobile" name="mobile" placeholder="" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label >Password <span class="login-danger">*</span></label>
                                        <input class="form-control" type="password" placeholder="" id="password" name="password" >
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label >Confirm Password <span class="login-danger">*</span></label>
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
                                                <input type="radio" name="status" id="status" class="form-check-input" value="0">Active
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" id="status" name="status" class="form-check-input" value="1">In Active
                                            </label>
                                        </div>
                                        <label id="status-error" class="error" for="status"></label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="doctor-submit text-center">
                                        <button type="submit" class="btn btn-primary submit-form me-2">Submit</button>
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
<style>
    .settings-btn .hide-input{
        width: 30% !important;
        margin-left: 404px  !important;
        margin-top: -15px  !important;
    }
</style>
<script>
    $(document).ready(function($) {

        $("#add_reception").validate({
            // Specify validation rules
            rules: {
                name: "required",
                email: "required",
                mobile: {
                    required: true,
                    maxlength: 10
                },
                password: {
                    required: true,
                    minlength: 6
                },
                cpassword: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                },
                status: "required"
            },
            // Specify validation error messages
            messages: {
                name: "Please enter first name",
                email: "Please enter the email",
                mobile: {
                    required: "Please enter the mobile",
                    maxlength: "Please enter maximum 10 digit number"
                },
                password: "Please enter password",
                cpassword: {
                    required: 'Confirm Password is required',
                    equalTo: 'Password not matching',
                },
                status: "Please select status",
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
    </script>
@endsection


