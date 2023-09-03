<?php $page="doctor";?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-12">

                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ url('doctor/store') }}" id="add_doctor" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-heading">
                                        <h4>Add Doctor</h4>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="form-group local-forms">
                                        <label >First Name <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" id="first_name" name="first_name"  placeholder="" >
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="form-group local-forms">
                                        <label >Last Name <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" id="last_name" name="last_name" placeholder="" >
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="form-group local-forms">
                                        <label >User Name <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" id="username" name="username" placeholder="" >
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label >Mobile <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" id="mobile_number" name="mobile_number" placeholder="" >
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
                                    <div class="form-group local-forms cal-icon">
                                        <label >Date Of Birth  <span class="login-danger">*</span></label>
                                        <input class="form-control datetimepicker" type="text"  placeholder="" id="dob" name="dob" >
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group select-gender">
                                        <label class="gen-label">Gender<span class="login-danger">*</span></label>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="gender" class="form-check-input" value="male">Male
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="gender" class="form-check-input" value="female">Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="form-group local-forms">
                                        <label >Education <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" placeholder="" id="education" name="education">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="form-group local-forms">
                                        <label >Designation <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" placeholder="" id="designation" name="designation">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="form-group local-forms">
                                        <label >Department <span class="login-danger">*</span></label>
                                        {!! Form::select('department_id', $department, null, ['class' => 'form-control select','id' => 'department_id']) !!}
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12">
                                    <div class="form-group local-forms">
                                        <label>Address  <span class="login-danger">*</span></label>
                                        <textarea class="form-control" rows="3" cols="30" id="address" name="address"></textarea>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="form-group local-forms">
                                        <label >Country  <span class="login-danger">*</span></label>
                                        {!! Form::select('country_id', $country, null, ['class' => 'form-control select','id' => 'country_id']) !!}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="form-group local-forms">
                                        <label >State/Province <span class="login-danger">*</span></label>
                                        {!! Form::select('state_id', $states, null, ['class' => 'form-control select','id' => 'state_id']) !!}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="form-group local-forms">
                                        <label >City <span class="login-danger">*</span></label>
                                        {!! Form::select('city_id', $city, null, ['class' => 'form-control select','id' => 'city_id']) !!}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="form-group local-forms">
                                        <label >Postal Code <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" placeholder="" id="postal_code" name="postal_code">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12">
                                    <div class="form-group local-forms">
                                        <label>Start Biography  <span class="login-danger">*</span></label>
                                        <textarea class="form-control" rows="3" cols="30" id="biography" name="biography"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-top-form">
                                        <label class="local-top">Profile Image <span class="login-danger">*</span></label>
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
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="doctor-submit text-center">
                                        <button type="submit" class="btn btn-primary submit-form me-2">Submit</button>
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
@endsection


