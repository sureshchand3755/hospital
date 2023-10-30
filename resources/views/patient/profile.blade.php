<?php $page = 'index'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        @include('layout.partials.flash-message')
        <div class="content">
            <div class="row">
                <div class="col-12">
                    <div class="form-heading">
                        <h4>My Profile</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <ul class="nav nav-tabs d-none d-lg-flex" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">User Info</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Change Password</button>
                        </li>

                      </ul>
                      <div class="tab-content accordion" id="myTabContent">
                        <div class="tab-pane fade show active accordion-item" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                          <div id="collapseOne" class="accordion-collapse collapse show  d-lg-block" aria-labelledby="headingOne" data-bs-parent="#myTabContent">
                            <div class="accordion-body">
                                <form method="POST" action="{{ route('profile.update') }}" id="update_profile"
                                enctype="multipart/form-data">
                                @csrf
                                @if(Auth::user()->type==3)
                                    @include('admin.profile')
                                @elseif(Auth::user()->type==2)
                                    @include('hospital.profile')
                                @endif

                            </form>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade accordion-item" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                          <div id="collapseTwo" class="accordion-collapse collapse d-lg-block" aria-labelledby="headingTwo" data-bs-parent="#myTabContent">
                            <div class="accordion-body">
                                <form method="POST" action="{{ route('change_password') }}" id="update_password"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-md-6 col-xl-6">
                                        <div class="form-group local-forms">
                                            <label>New Password <span class="login-danger">*</span></label>
                                            <input class="form-control" type="password" placeholder="" id="password"
                                                name="password">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-6">
                                        <div class="form-group local-forms">
                                            <label>Confirm Password <span class="login-danger">*</span></label>
                                            <input class="form-control" type="password" placeholder="" id="cpassword"
                                                name="cpassword">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="doctor-submit text-center">
                                            <button type="submit" class="btn btn-primary submit-form me-2">Update</button>
                                            <button type="submit" class="btn btn-primary cancel-form">Cancel</button>
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

        </div>
    </div>
<style>
    #update_profile .settings-btn .hide-input{
        position: absolute;
        z-index: 99;
        cursor: pointer;
        min-height: 50px;
        padding-left: 4px;
        padding-top: 0;
        /* line-height: 10px; */
        width: 100%;
        /* opacity: 0; */
        margin-left: 0px;
        margin-top: -10px;
    }

</style>
    <script>
        $(document).ready(function() {

            $("#update_profile").validate({
                // Specify validation rules
                rules: {
                    name: "required",
                    email: "required",
                },
                // Specify validation error messages
                messages: {
                    name: "Please enter first name",
                    email: "Please enter the email",
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
            $("#update_password").validate({
                // Specify validation rules
                rules: {
                    password: {
                        required: true,
                        minlength: 6
                    },
                    cpassword: {
                        required: true,
                        minlength: 6,
                        equalTo: "#password"
                    },
                },
                // Specify validation error messages
                messages: {
                    password: "Please enter password",
                    cpassword: {
                        required: 'Confirm Password is required',
                        equalTo: 'Password not matching',
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });

        });
    </script>
@endsection
