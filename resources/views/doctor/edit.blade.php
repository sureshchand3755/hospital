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
                        <form method="POST" action="{{ url('doctor/update') }}" id="add_doctor" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-heading">
                                        <h4>Edit Doctor</h4>
                                    </div>
                                </div>
                                <input type="text" name="id" value="{{$data->id}}" style="display: none">
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="form-group local-forms">
                                        <label >First Name <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" id="first_name" value="{{ isset($data->doctorinfo)? $data->doctorinfo->first_name:''}}" name="first_name"  placeholder="" >
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="form-group local-forms">
                                        <label >Last Name <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" id="last_name" name="last_name" value="{{ isset($data->doctorinfo)? $data->doctorinfo->last_name:''}}"  placeholder="" >
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="form-group local-forms">
                                        <label >User Name <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" id="username" name="username" value="{{$data->name}}" placeholder="" >
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label >Mobile <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" id="mobile_number" name="mobile_number" placeholder="" value="{{$data->mobile}}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label >Email <span class="login-danger">*</span></label>
                                        <input class="form-control" type="email" id="email" name="email" placeholder="" value="{{ $data->email}}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label >Password <span class="login-danger">*</span></label>
                                        <input class="form-control" type="password" placeholder="" id="password" name="password" value="{{ $data->password}}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label >Confirm Password <span class="login-danger">*</span></label>
                                        <input class="form-control" type="password" placeholder="" id="cpassword" name="cpassword" value="{{$data->password}}">
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
                                                <input type="radio" name="gender" class="form-check-input" value="male" {{ $data->doctorinfo && $data->doctorinfo->gender == 'male' ? 'checked' : '' }}>Male
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="gender" class="form-check-input" value="female" {{ $data->doctorinfo && $data->doctorinfo->gender == 'female' ? 'checked' : '' }}>Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="form-group local-forms">
                                        <label >Education <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" placeholder="" id="education" name="education" value="{{ isset($data->doctorinfo)? $data->doctorinfo->education:''}}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="form-group local-forms">
                                        <label >Designation <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" placeholder="" id="designation" name="designation" value="{{ isset($data->doctorinfo)? $data->doctorinfo->designation:''}}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="form-group local-forms">
                                        <label >Department <span class="login-danger">*</span></label>
                                        {!! Form::select('department_id', $department, $data->doctorinfo && $data->doctorinfo->department_id, ['class' => 'form-control select','id' => 'department_id']) !!}
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12">
                                    <div class="form-group local-forms">
                                        <label>Address  <span class="login-danger">*</span></label>
                                        <textarea class="form-control" rows="3" cols="30" id="address" name="address">{{ isset($data->doctorinfo)? $data->doctorinfo->address:''}}</textarea>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="form-group local-forms">
                                        <label >Country  <span class="login-danger">*</span></label>
                                        {!! Form::select('country_id', $country, isset($data->doctorinfo)? $data->doctorinfo->country_id:'', ['class' => 'form-control select','id' => 'country_id']) !!}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="form-group local-forms">
                                        <label >State/Province <span class="login-danger">*</span></label>
                                        {!! Form::select('state_id', [], null, ['class' => 'form-control select','id' => 'state_id']) !!}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="form-group local-forms">
                                        <label >City <span class="login-danger">*</span></label>
                                        {!! Form::select('city_id', [], null, ['class' => 'form-control select','id' => 'city_id']) !!}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="form-group local-forms">
                                        <label >Postal Code <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" placeholder="" id="postal_code" name="postal_code"  value="{{isset($data->doctorinfo)? $data->doctorinfo->postal_code:''}}">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12">
                                    <div class="form-group local-forms">
                                        <label>Start Biography </label>
                                        <textarea class="form-control" rows="3" cols="30" id="biography" name="biography">{{ isset($data->doctorinfo)? $data->doctorinfo->biography:''}}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-top-form">
                                        <label class="local-top">Profile Image <span class="login-danger">*</span></label>
                                        <div class="settings-btn upload-files-avator">
                                            <input type="text" id="profileimage" name="edit_profile_image">
                                            <input type="file" accept="image/*" name="profile_image" id="profile_image" onchange="loadFile(event)" class="hide-input">
                                            <label for="file" class="upload">Choose File</label>

                                        </div>
                                        <div class="upload-images upload-size">
                                            <img id="profileimg" src="{{($data->doctorinfo->profile_image!='')?URL::to('images/'.$data->doctorinfo->profile_image):URL::to('public/assets/img/profiles/avatar-01.jpg')}}" alt="Image">
                                            <a href="javascript:void(0);" class="btn-icon logo-hide-btn">
                                                <i class="feather-x-circle"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group select-gender">
                                        <label class="gen-label">Status <span class="login-danger">*</span></label>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="status" id="status" class="form-check-input" value="0" {{ $data->doctorinfo && $data->doctorinfo->status == '0' ? 'checked' : '' }}>Active
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" id="status" name="status" class="form-check-input" value="1" {{ $data->doctorinfo && $data->doctorinfo->status == '1' ? 'checked' : ''}}>In Active
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
        var countryId = "{{isset($data->doctorinfo)? $data->doctorinfo->country_id:'' }}";
        var stateId = "{{isset($data->doctorinfo)? $data->doctorinfo->state_id:'' }}";
        var cityId = "{{isset($data->doctorinfo)? $data->doctorinfo->city_id:'' }}";

        var dob = "{{ isset($data->doctorinfo)? date('d/m/Y', strtotime($data->doctorinfo->date_of_birth)) : '' }}";
        $('#dob').val(dob);
        var url = $('img#profileimg').attr('src');
        console.log(url);
        $('#profileimage').val(url)
        $("#profile_image").change(function(){
            var file = $(this).prop('files')[0];
            $('#profileimage').val(file.name)
        });

        $("#add_doctor").validate({
        // Specify validation rules
        rules: {
            first_name: "required",
            last_name: "required",
            username: "required",
            mobile_number: "required",
            email: "required",
            password: {
                required: true,
                minlength: 5
            },
            cpassword: {
                required: true,
                minlength: 5,
                equalTo: "#password"
            },
            dob: "required",
            gender: "required",
            education: "required",
            designation: "required",
            department_id: "required",
            address: "required",
            country_id: "required",
            state_id: "required",
            city_id: "required",
            postal_code: "required",
            edit_profile_image: "required",
            status: "required",
        },
        // Specify validation error messages
        messages: {
            first_name: "Please enter first name",
            last_name: "Please enter last name",
            username: "Please enter username",
            mobile_number: "Please enter mobile number",
            email: "Please enter emsil",
            password: "Please enter password",
            cpassword: {
                required : 'Confirm Password is required',
                equalTo : 'Password not matching',
            },
            dob: "Please select date of birth",
            gender: "Please select gender",
            education: "Please enter education",
            designation: "Please enter designation",
            department_id: "Please select department",
            address: "Please enter address",
            country_id: "Please select country",
            state_id: "Please select state",
            city_id: "Please select city",
            postal_code: "Please enter postal code",
            edit_profile_image: "Please upload profile image",
            status: "Please select status",
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    selectState(countryId, stateId);
    selectCity(stateId, cityId);
});
    function selectState(country_id, state_id){
        $.ajax({
                url: "{{url('fetch-states')}}",
                type: "POST",
                data: {
                    country_id: country_id,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#state_id').html('<option value="">Select State</option>');
                    $.each(result.states, function (key, value) {
                        $("#state_id").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                    $('#state_id').val(state_id)
                }

            });
    }
    function selectCity(state_id, city_id){
        $.ajax({
            url: "{{url('fetch-cities')}}",
            type: "POST",
            data: {
                state_id: state_id,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (res) {
                $('#city_id').html('<option value="">Select City</option>');
                $.each(res.cities, function (key, value) {
                    $("#city_id").append('<option value="' + value
                        .id + '">' + value.name + '</option>');
                });
                $('#city_id').val(city_id)
            }
        });
    }
</script>
@endsection


