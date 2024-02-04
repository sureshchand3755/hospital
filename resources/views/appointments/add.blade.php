<?php $page="appointments";?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-heading">
                    <h4>Add Patient</h4>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{url('appointment/store')}}" id="add_appointment">
                            @csrf
                            <div class="card-box">
                                <h3 class="card-title">General Details</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Subtitle</label>
                                            <input class="form-control" type="text" placeholder="" name="subtitle" id="subtitle" value="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Patient Name <span class="login-danger">*</span></label>
                                            <input class="form-control" type="text" placeholder="" name="patient_name" id="patient_name" value="">
                                                <x-input-error :messages="$errors->get('patient_name')" class="mt-2  text-danger" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Phone <span class="login-danger">*</span></label>
                                            <input class="form-control" type="text" placeholder="" name="phone_number" id="phone_number" value="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Email</label>
                                            <input class="form-control" type="text" placeholder="" name="email" id="email" value="">
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-xl-4">
                                        <div class="form-group local-forms cal-icon">
                                            <label>Date Of Birth <span class="login-danger">*</span></label>
                                            <input class="form-control datetimepicker" type="text" placeholder=""
                                                name="date_of_birth" id="date_of_birth"
                                                value="">
                                                <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2  text-danger" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-4">
                                        <div class="form-group local-forms">
                                            <label>Age <span class="login-danger">*</span></label>
                                            <input class="form-control" type="text" placeholder="" name="age" id="age" value="">
                                            <x-input-error :messages="$errors->get('age')" class="mt-2  text-danger" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-4">
                                        <div class="form-group select-gender">
                                            <label class="gen-label">Gender<span class="login-danger">*</span></label>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" name="gender" class="form-check-input" value="male">Male
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" name="gender" class="form-check-input"
                                                        value="female"
                                                        >Female
                                                </label>
                                            </div>
                                            <x-input-error :messages="$errors->get('gender')" class="mt-2  text-danger" />
                                            <label id="gender-error" class="error __web-inspector-hide-shortcut__" for="gender"></label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-4">
                                        <div class="form-group local-forms">
                                            <label>Aadhar</label>
                                            <input class="form-control" type="text" placeholder="" name="aadhar_number"
                                                id="aadhar_number"
                                                value="" maxLength="19">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group select-gender">
                                            <label class="gen-label"></label>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" name="father_or_husband" class="form-check-input"
                                                        value="F"
                                                        >Father
                                                    /
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" name="father_or_husband" class="form-check-input"
                                                        value="H"
                                                        >Husband
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-5">
                                        <div class="form-group local-forms">
                                            <label></label>
                                            <input class="form-control" type="text"
                                                placeholder="Enter Father / Husband Name" name="father_or_husband_name"
                                                id="father_or_husband_name"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group select-gender">
                                            <label class="gen-label"></label>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" name="mother_or_wife" class="form-check-input"
                                                        value="M"
                                                        >Mother
                                                    /
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" name="mother_or_wife" class="form-check-input"
                                                        value="W"
                                                        >Wife
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-5">
                                        <div class="form-group local-forms">
                                            <label></label>
                                            <input class="form-control" type="text" placeholder="Enter Mother / Wife Name"
                                                name="mother_or_wife_name" id="mother_or_wife_name"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-4">
                                        <div class="form-group local-forms">
                                            <label>Guardian Name</label>
                                            <input class="form-control" type="text" placeholder="" name="guardian_name"
                                                id="guardian_name"
                                                value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-box">
                                <h3 class="card-title">Contact Details</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-12 col-md-12 col-xl-12">
                                        <div class="form-group local-forms">
                                            <label>Address <span class="login-danger">*</span></label>
                                            <textarea class="form-control" rows="2" cols="15" name="address" id="address"></textarea>
                                            <x-input-error :messages="$errors->get('address')" class="mt-2  text-danger" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>State/Province <span class="login-danger">*</span></label>
                                            {!! Form::select('state_id', $states, null, ['class' => 'form-control select','id' => 'state_id']) !!}
                                            <x-input-error :messages="$errors->get('state_id')" class="mt-2  text-danger" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>City <span class="login-danger">*</span></label>
                                            <select class="form-control select" name="city_id" id="city_id">
                                            </select>
                                            <x-input-error :messages="$errors->get('city_id')" class="mt-2  text-danger" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Postal Code <span class="login-danger">*</span></label>
                                            <input class="form-control" type="text" placeholder="" name="postal_code"
                                                id="postal_code"
                                                value="">
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Education</label>
                                            <input class="form-control" type="text" placeholder="" name="education"
                                                id="education"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Ref.By</label>
                                            <input class="form-control" type="text" placeholder="" name="ref_by"
                                                id="ref_by"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Occupation</label>
                                            <input class="form-control" type="text" placeholder="" name="occupation"
                                                id="occupation"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group select-gender">
                                            <label class="gen-label"></label>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" name="send_alert" id="send_alert"
                                                        class="form-check-input" value="Y"
                                                        >Send
                                                    Alert
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @if (Auth::user()->type==1)
                            <div class="card-box">
                                <h3 class="card-title">Medical Details</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Blood</label>
                                            <input class="form-control" type="text" placeholder="" name="blood"
                                                id="blood"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Diet</label>
                                            <input class="form-control" type="text" placeholder="" name="diet"
                                                id="diet"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Height</label>
                                            <input class="form-control" type="text" placeholder="" name="height"
                                                id="height"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Weight</label>
                                            <input class="form-control" type="text" placeholder="" name="weight"
                                                id="weight"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-2">
                                        <div class="form-group local-forms">
                                            <label>Birth Wgt</label>
                                            <input class="form-control" type="text" placeholder="" name="brith_weight"
                                                id="brith_weight"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-5">
                                        <div class="form-group local-forms">
                                            <label>Allergic to any Mediciens / Any Medical Conditions</label>
                                            <textarea class="form-control" rows="2" cols="15" name="any_mediciens" id="any_mediciens"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-5">
                                        <div class="form-group local-forms">
                                            <label>Note</label>
                                            <textarea class="form-control" rows="2" cols="15" name="note" id="note"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="card-box">
                                <h3 class="card-title">Doctor Details</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Doctor <span class="login-danger">*</span></label>
                                            {!! Form::select('doctor_id', $doctor, null, ['class' => 'form-control select','id' => 'doctor_id']) !!}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Department <span class="login-danger">*</span></label>
                                            {!! Form::select('department_id', [], null, ['class' => 'form-control select','id' => 'department_id']) !!}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms cal-icon">
                                            <label>Date <span class="login-danger">*</span></label>
                                            <input class="form-control datetimepicker" type="text" placeholder=""
                                                name="appoinment_date" id="appoinment_date"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Visit <span class="login-danger">*</span></label>
                                            {!! Form::select('visit_id', Config::get('constants.visit'), null, ['class' => 'form-control select','id' => 'visit_id']) !!}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Illness</label>
                                            {!! Form::select('illness_id', Config::get('constants.illness'), null, ['class' => 'form-control select','id' => 'illness_id']) !!}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Appointment Mode</label>
                                            {!! Form::select('appointment_mode_id', Config::get('constants.appoinment_mode'), null, ['class' => 'form-control select','id' => 'appointment_mode_id']) !!}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Symptoms</label>
                                            {!! Form::select('symptoms_id', Config::get('constants.symptoms'), null, ['class' => 'form-control select','id' => 'symptoms_id']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="doctor-submit text-center">
                                <button type="submit" class="btn btn-primary submit-btn mb-4">Create</button>
                                <button type="submit" class="btn btn-primary cancel-form  mb-4" onclick="window.history.go(-1); return false;">Cancel</button>
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
        $('#date_of_birth').datetimepicker(
        { "format": 'DD/MM/YYYY' }).on('dp.change', function (e) {
            var dob = $('#date_of_birth').val();
            console.log(dob)
            if(dob != ''){
                var age = moment().diff(moment(dob, 'DD/MM/YYYY'), 'years');
                $('#age').val(age);
            }
        });
        $('#aadhar_number').keyup(function() {
            var value = $(this).val();
            value = value.replace(/\D/g, "").split(/(?:([\d]{4}))/g).filter(s => s.length > 0).join("-");
            $(this).val(value);
        });
        $("#add_appointment").validate({
            rules: {
                patient_name: "required",
                date_of_birth: "required",
                age: "required",
                gender: "required",
                address: "required",
                state_id: "required",
                city_id: "required",
                postal_code: "required",
                phone_number: "required",
                doctor_id: "required",
                appoinment_date: "required",
                visit_id: "required",
            },
            messages: {
                patient_name: "Please enter patient name",
                date_of_birth: "Please select date of birth",
                age: "Please enter age",
                gender: "Please select gender",
                address: "Please enter address",
                state_id: "Please select state",
                city_id: "Please select city",
                postal_code: "Please enter postal code",
                phone_number: "Please enter phone number",
                doctor_id: "Please select doctor",
                appoinment_date: "Please select date",
                visit_id: "Please select visit",
            }
        });
        $('#state_id').on('change', function () {
            var idState = this.value;
            $("#city_id").html('');
            $.ajax({
                url: "{{url('fetch-cities')}}",
                type: "POST",
                data: {
                    state_id: idState,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (res) {
                    $('#city_id').html('<option value="">Select City</option>');
                    $.each(res.cities, function (key, value) {
                        $("#city_id").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });
        $('#doctor_id').on('change', function () {
            var idState = this.value;
            $("#department_id").html('');
            $.ajax({
                url: "{{url('fetch-department')}}",
                type: "POST",
                data: {
                    doctor_id: idState,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (res) {
                    // $('#city').html('<option value="">Select City</option>');
                    $.each(res.department, function (key, value) {
                        $("#department_id").append('<option value="' + value
                            .id + '">' + value.department_name + '</option>');
                    });
                }
            });
        });
    });
</script>
@endsection

