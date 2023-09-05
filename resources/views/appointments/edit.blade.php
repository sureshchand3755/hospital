<?php $page="appointments";?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-heading">
                    <h4>Edit Patient</h4>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{(Auth::user()->type==0)?url('appointment/update'):url('admin/appointment/update')}}" id="add_appointment">
                            @csrf
                            <input type="text" name="id" value="{{$data->id}}" style="display: none">
                            <div class="card-box">
                                <h3 class="card-title">General Details</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Subtitle</label>
                                            <input class="form-control" type="text" placeholder="" name="subtitle" id="subtitle" value="{{ $data && $data->subtitle ? $data->subtitle : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Patient Name <span class="login-danger">*</span></label>
                                            <input class="form-control" type="text" placeholder="" name="patient_name" id="patient_name" value="{{ $data && $data->patient_name ? $data->patient_name : '' }}">
                                                <x-input-error :messages="$errors->get('patient_name')" class="mt-2  text-danger" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Phone <span class="login-danger">*</span></label>
                                            <input class="form-control" type="text" placeholder="" name="phone_number" id="phone_number" value="{{ $data && $data->phone_number ? $data->phone_number : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Email</label>
                                            <input class="form-control" type="text" placeholder="" name="email" id="email" value="{{ $data && $data->email ? $data->email : '' }}">
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
                                            <input class="form-control" type="text" placeholder="" name="age" id="age" value="{{ $data && $data->age ? $data->age : '' }}">
                                            <x-input-error :messages="$errors->get('age')" class="mt-2  text-danger" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-4">
                                        <div class="form-group select-gender">
                                            <label class="gen-label">Gender<span class="login-danger">*</span></label>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" name="gender" class="form-check-input" value="male"  {{ $data && $data->gender == 'male' ? 'checked' : '' }}>Male
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" name="gender" class="form-check-input"
                                                        value="female" {{ $data && $data->gender == 'female' ? 'checked' : '' }}>Female
                                                </label>
                                            </div>
                                            <x-input-error :messages="$errors->get('gender')" class="mt-2  text-danger" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-4">
                                        <div class="form-group local-forms">
                                            <label>Aadhar</label>
                                            <input class="form-control" type="text" placeholder="" name="aadhar_number" id="aadhar_number" value="{{ $data && $data->aadhar_number ? $data->aadhar_number : '' }}" maxLength="19">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group select-gender">
                                            <label class="gen-label"></label>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" name="father_or_husband" class="form-check-input" value="F" {{ $data && $data->father_or_husband == 'F' ? 'checked' : '' }}>Father
                                                    /
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" name="father_or_husband" class="form-check-input"
                                                        value="H" {{ $data && $data->father_or_husband == 'H' ? 'checked' : '' }}>Husband
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
                                                value="{{ $data && $data->father_or_husband_name ? $data->father_or_husband_name : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group select-gender">
                                            <label class="gen-label"></label>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" name="mother_or_wife" class="form-check-input"
                                                        value="M" {{ $data && $data->mother_or_wife == 'M' ? 'checked' : '' }}>Mother
                                                    /
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" name="mother_or_wife" class="form-check-input"
                                                        value="W" {{ $data && $data->mother_or_wife == 'W' ? 'checked' : '' }}>Wife
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-5">
                                        <div class="form-group local-forms">
                                            <label></label>
                                            <input class="form-control" type="text" placeholder="Enter Mother / Wife Name"
                                                name="mother_or_wife_name" id="mother_or_wife_name"
                                                value="{{ $data && $data->mother_or_wife_name ? $data->mother_or_wife_name : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-4">
                                        <div class="form-group local-forms">
                                            <label>Guardian Name</label>
                                            <input class="form-control" type="text" placeholder="" name="guardian_name"
                                                id="guardian_name"
                                                value="{{ $data && $data->guardian_name ? $data->guardian_name : '' }}">
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
                                            <textarea class="form-control" rows="2" cols="15" name="address" id="address">{{ $data && $data->address ? $data->address : '' }}</textarea>
                                            <x-input-error :messages="$errors->get('address')" class="mt-2  text-danger" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>State/Province <span class="login-danger">*</span></label>
                                            {!! Form::select('state_id', $states, $data->state_id, ['class' => 'form-control select','id' => 'state_id']) !!}
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
                                                value="{{ $data && $data->postal_code ? $data->postal_code : '' }}">
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Education</label>
                                            <input class="form-control" type="text" placeholder="" name="education"
                                                id="education"
                                                value="{{ $data && $data->education ? $data->education : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Ref.By</label>
                                            <input class="form-control" type="text" placeholder="" name="ref_by"
                                                id="ref_by"
                                                value="{{ $data && $data->ref_by ? $data->ref_by : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Occupation</label>
                                            <input class="form-control" type="text" placeholder="" name="occupation"
                                                id="occupation"
                                                value="{{ $data && $data->occupation ? $data->occupation : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group select-gender">
                                            <label class="gen-label"></label>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" name="send_alert" id="send_alert"
                                                        class="form-check-input" value="Y" {{ $data && $data->send_alert == 'Y' ? 'checked' : '' }}
                                                        >Send
                                                    Alert
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-box">
                                <h3 class="card-title">Medical Details</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Blood</label>
                                            <input class="form-control" type="text" placeholder="" name="blood"
                                                id="blood"
                                                value="{{ $data && $data->blood ? $data->blood : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Diet</label>
                                            <input class="form-control" type="text" placeholder="" name="diet"
                                                id="diet"
                                                value="{{ $data && $data->diet ? $data->diet : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Height</label>
                                            <input class="form-control" type="text" placeholder="" name="height"
                                                id="height"
                                                value="{{ $data && $data->height ? $data->height : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Weight</label>
                                            <input class="form-control" type="text" placeholder="" name="weight"
                                                id="weight"
                                                value="{{ $data && $data->weight ? $data->weight : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-2">
                                        <div class="form-group local-forms">
                                            <label>Birth Wgt</label>
                                            <input class="form-control" type="text" placeholder="" name="brith_weight"
                                                id="brith_weight"
                                                value="{{ $data && $data->brith_weight ? $data->brith_weight : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-5">
                                        <div class="form-group local-forms">
                                            <label>Allergic to any Mediciens / Any Medical Conditions</label>
                                            <textarea class="form-control" rows="2" cols="15" name="any_mediciens" id="any_mediciens">{{ $data && $data->any_mediciens ? $data->any_mediciens : '' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-5">
                                        <div class="form-group local-forms">
                                            <label>Note</label>
                                            <textarea class="form-control" rows="2" cols="15" name="note" id="note">{{ $data && $data->note ? $data->note : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-box">
                                <h3 class="card-title">Doctor Details</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Doctor <span class="login-danger">*</span></label>
                                            {!! Form::select('doctor_id', $doctor, $data->doctor_id, ['class' => 'form-control select','id' => 'doctor_id']) !!}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="form-group local-forms">
                                            <label>Department <span class="login-danger">*</span></label>
                                            {!! Form::select('department_id', [], null, ['class' => 'form-control select','id' => 'department_id']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="doctor-submit text-center">
                                <button type="submit" class="btn btn-primary submit-btn mb-4">Update</button>
                                <button type="submit" class="btn btn-primary cancel-form  mb-4">Cancel</button>
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
    var stateId = "{{ isset($data->state_id)?$data->state_id:0}}";
    var cityId = "{{ isset($data->city_id)?$data->city_id:0}}";

    var doctorId = "{{ isset($data->doctor_id)?$data->doctor_id:''}}";
    var departId = "{{ isset($data->department_id)?$data->department_id:''}}";

    var dob = "{{ $data && $data->date_of_birth ? date('m/d/Y', strtotime($data->date_of_birth)) : '' }}";
    $('#date_of_birth').val(dob);
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
    selectCity(stateId, cityId);
    selectDepartment(doctorId, departId);
});
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
function selectDepartment(doctor_id, department_id){
    $.ajax({
        url: "{{url('fetch-department')}}",
        type: "POST",
        data: {
            doctor_id: doctor_id,
            _token: '{{csrf_token()}}'
        },
        dataType: 'json',
        success: function (res) {
            $.each(res.department, function (key, value) {
                $("#department_id").append('<option value="' + value
                    .id + '">' + value.department_name + '</option>');
            });
            $('#department_id').val(department_id)
        }
    });
}
</script>
@endsection

