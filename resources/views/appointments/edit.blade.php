<?php $page = 'appointments'; ?>
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
                            @php
                                $updateUrl = url('appointment/update');
                            @endphp
                            @if (Auth::user()->type == 1)
                                @php
                                    $updateUrl = url('doctor/appointment/update');
                                @endphp
                            @elseif(Auth::user()->type == 3)
                                @php
                                    $updateUrl = url('admin/appointment/update');
                                @endphp
                            @endif

                            <form method="POST" action="{{ $updateUrl }}" id="add_appointment">
                                @csrf
                                <input type="text" name="id" value="{{ $data->id }}" style="display: none">
                                @if (Auth::user()->type == 0 || Auth::user()->type == 3)
                                    <div class="card-box">
                                        <h3 class="card-title">General Details</h3>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12 col-md-6 col-xl-3">
                                                <div class="form-group local-forms">
                                                    <label>Subtitle</label>
                                                    <input class="form-control" type="text" placeholder=""
                                                        name="subtitle" id="subtitle"
                                                        value="{{ $data && $data->subtitle ? $data->subtitle : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-3">
                                                <div class="form-group local-forms">
                                                    <label>Patient Name <span class="login-danger">*</span></label>
                                                    <input class="form-control" type="text" placeholder=""
                                                        name="patient_name" id="patient_name"
                                                        value="{{ $data && $data->patient_name ? $data->patient_name : '' }}">
                                                    <x-input-error :messages="$errors->get('patient_name')" class="mt-2  text-danger" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-3">
                                                <div class="form-group local-forms">
                                                    <label>Phone <span class="login-danger">*</span></label>
                                                    <input class="form-control" type="text" placeholder=""
                                                        name="phone_number" id="phone_number"
                                                        value="{{ $data && $data->phone_number ? $data->phone_number : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-3">
                                                <div class="form-group local-forms">
                                                    <label>Email</label>
                                                    <input class="form-control" type="text" placeholder="" name="email"
                                                        id="email"
                                                        value="{{ $data && $data->email ? $data->email : '' }}">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6 col-xl-4">
                                                <div class="form-group local-forms cal-icon">
                                                    <label>Date Of Birth <span class="login-danger">*</span></label>
                                                    <input class="form-control datetimepicker" type="text" placeholder=""
                                                        name="date_of_birth" id="date_of_birth" value="">
                                                    <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2  text-danger" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-4">
                                                <div class="form-group local-forms">
                                                    <label>Age <span class="login-danger">*</span></label>
                                                    <input class="form-control" type="text" placeholder="" name="age"
                                                        id="age" value="{{ $data && $data->age ? $data->age : '' }}">
                                                    <x-input-error :messages="$errors->get('age')" class="mt-2  text-danger" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-4">
                                                <div class="form-group select-gender">
                                                    <label class="gen-label">Gender<span
                                                            class="login-danger">*</span></label>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" name="gender" class="form-check-input"
                                                                value="male"
                                                                {{ $data && $data->gender == 'male' ? 'checked' : '' }}>Male
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" name="gender" class="form-check-input"
                                                                value="female"
                                                                {{ $data && $data->gender == 'female' ? 'checked' : '' }}>Female
                                                        </label>
                                                    </div>
                                                    <x-input-error :messages="$errors->get('gender')" class="mt-2  text-danger" />
                                                    <label id="gender-error" class="error __web-inspector-hide-shortcut__" for="gender"></label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-4">
                                                <div class="form-group local-forms">
                                                    <label>Aadhar</label>
                                                    <input class="form-control" type="text" placeholder=""
                                                        name="aadhar_number" id="aadhar_number"
                                                        value="{{ $data && $data->aadhar_number ? $data->aadhar_number : '' }}"
                                                        maxLength="19">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-3">
                                                <div class="form-group select-gender">
                                                    <label class="gen-label"></label>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" name="father_or_husband"
                                                                class="form-check-input" value="F"
                                                                {{ $data && $data->father_or_husband == 'F' ? 'checked' : '' }}>Father
                                                            /
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" name="father_or_husband"
                                                                class="form-check-input" value="H"
                                                                {{ $data && $data->father_or_husband == 'H' ? 'checked' : '' }}>Husband
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-5">
                                                <div class="form-group local-forms">
                                                    <label></label>
                                                    <input class="form-control" type="text"
                                                        placeholder="Enter Father / Husband Name"
                                                        name="father_or_husband_name" id="father_or_husband_name"
                                                        value="{{ $data && $data->father_or_husband_name ? $data->father_or_husband_name : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-3">
                                                <div class="form-group select-gender">
                                                    <label class="gen-label"></label>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" name="mother_or_wife"
                                                                class="form-check-input" value="M"
                                                                {{ $data && $data->mother_or_wife == 'M' ? 'checked' : '' }}>Mother
                                                            /
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" name="mother_or_wife"
                                                                class="form-check-input" value="W"
                                                                {{ $data && $data->mother_or_wife == 'W' ? 'checked' : '' }}>Wife
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-5">
                                                <div class="form-group local-forms">
                                                    <label></label>
                                                    <input class="form-control" type="text"
                                                        placeholder="Enter Mother / Wife Name" name="mother_or_wife_name"
                                                        id="mother_or_wife_name"
                                                        value="{{ $data && $data->mother_or_wife_name ? $data->mother_or_wife_name : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-4">
                                                <div class="form-group local-forms">
                                                    <label>Guardian Name</label>
                                                    <input class="form-control" type="text" placeholder=""
                                                        name="guardian_name" id="guardian_name"
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
                                                    {!! Form::select('state_id', $states, $data->state_id, ['class' => 'form-control select', 'id' => 'state_id']) !!}
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
                                                    <input class="form-control" type="text" placeholder=""
                                                        name="postal_code" id="postal_code"
                                                        value="{{ $data && $data->postal_code ? $data->postal_code : '' }}">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6 col-xl-3">
                                                <div class="form-group local-forms">
                                                    <label>Education</label>
                                                    <input class="form-control" type="text" placeholder=""
                                                        name="education" id="education"
                                                        value="{{ $data && $data->education ? $data->education : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-3">
                                                <div class="form-group local-forms">
                                                    <label>Ref.By</label>
                                                    <input class="form-control" type="text" placeholder=""
                                                        name="ref_by" id="ref_by"
                                                        value="{{ $data && $data->ref_by ? $data->ref_by : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-3">
                                                <div class="form-group local-forms">
                                                    <label>Occupation</label>
                                                    <input class="form-control" type="text" placeholder=""
                                                        name="occupation" id="occupation"
                                                        value="{{ $data && $data->occupation ? $data->occupation : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-3">
                                                <div class="form-group select-gender">
                                                    <label class="gen-label"></label>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="send_alert" id="send_alert"
                                                                class="form-check-input" value="Y"
                                                                {{ $data && $data->send_alert == 'Y' ? 'checked' : '' }}>Send
                                                            Alert
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endif
                                @if (Auth::user()->type == 1)
                                    <div class="card-box">
                                        <h3 class="card-title">Medical Details</h3>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12 col-md-6 col-xl-3">
                                                <div class="form-group local-forms">
                                                    <label>Temp</label>
                                                    <input class="form-control" type="text" placeholder=""
                                                        name="temp" id="temp"
                                                        value="{{ $data && $data->temp ? $data->temp : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-3">
                                                <div class="form-group local-forms">
                                                    <label>Blood</label>
                                                    <input class="form-control" type="text" placeholder=""
                                                        name="blood" id="blood"
                                                        value="{{ $data && $data->blood ? $data->blood : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-3">
                                                <div class="form-group local-forms">
                                                    <label>Diet</label>
                                                    <input class="form-control" type="text" placeholder=""
                                                        name="diet" id="diet"
                                                        value="{{ $data && $data->diet ? $data->diet : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-3">
                                                <div class="form-group local-forms">
                                                    <label>Height</label>
                                                    <input class="form-control" type="text" placeholder=""
                                                        name="height" id="height"
                                                        value="{{ $data && $data->height ? $data->height : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-3">
                                                <div class="form-group local-forms">
                                                    <label>Weight</label>
                                                    <input class="form-control" type="text" placeholder=""
                                                        name="weight" id="weight"
                                                        value="{{ $data && $data->weight ? $data->weight : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-3">
                                                <div class="form-group local-forms">
                                                    <label>BP</label>
                                                    <input class="form-control" type="text" placeholder=""
                                                        name="bp" id="bp"
                                                        value="{{ $data && $data->bp ? $data->bp : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-3">
                                                <div class="form-group local-forms">
                                                    <label>Pulse</label>
                                                    <input class="form-control" type="text" placeholder=""
                                                        name="pulse" id="pulse"
                                                        value="{{ $data && $data->pulse ? $data->pulse : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-3">
                                                <div class="form-group local-forms">
                                                    <label>SPO2</label>
                                                    <input class="form-control" type="text" placeholder=""
                                                        name="spo2" id="spo2"
                                                        value="{{ $data && $data->spo2 ? $data->spo2 : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-3">
                                                <div class="form-group local-forms">
                                                    <label>Resp</label>
                                                    <input class="form-control" type="text" placeholder=""
                                                        name="resp" id="resp"
                                                        value="{{ $data && $data->resp ? $data->resp : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-3">
                                                <div class="form-group local-forms">
                                                    <label>CBG</label>
                                                    <input class="form-control" type="text" placeholder=""
                                                        name="cbg" id="cbg"
                                                        value="{{ $data && $data->cbg ? $data->cbg : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-3">
                                                <div class="form-group local-forms">
                                                    <label>Ref By</label>
                                                    <input class="form-control" type="text" placeholder=""
                                                        name="medical_ref_by" id="medical_ref_by"
                                                        value="{{ $data && $data->medical_ref_by ? $data->medical_ref_by : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-3">
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">BMI</label>
                                                    <div class="col-lg-9">
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <input class="form-control" type="text" name="bmi" id="bmi" readonly value="{{ $data && $data->bmi ? $data->bmi : '' }}">
                                                            </div>
                                                            <div class="col-md-7">
                                                            <span id="bmicategory"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-3">
                                                <div class="form-group local-forms">
                                                    <label>Pain Scale</label>
                                                    <input class="form-control" type="text" placeholder=""
                                                        name="pain_scale" id="pain_scale"
                                                        value="{{ $data && $data->pain_scale ? $data->pain_scale : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-2">
                                                <div class="form-group local-forms">
                                                    <label>Birth Wgt</label>
                                                    <input class="form-control" type="text" placeholder=""
                                                        name="brith_weight" id="brith_weight"
                                                        value="{{ $data && $data->brith_weight ? $data->brith_weight : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-5">
                                                <div class="form-group local-forms">
                                                    <label>Symptoms</label>
                                                    <textarea class="form-control" rows="2" cols="15" name="symptoms" id="symptoms">{{ $data && $data->symptoms ? $data->symptoms : '' }}</textarea>
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
                                @endif
                                <div class="card-box">
                                    <h3 class="card-title">Doctor Details</h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-xl-3">
                                            <div class="form-group local-forms">
                                                <label>Doctor <span class="login-danger">*</span></label>
                                                {!! Form::select('doctor_id', $doctor, $data->doctor_id, [
                                                    'class' => 'form-control select',
                                                    'id' => 'doctor_id',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-3">
                                            <div class="form-group local-forms">
                                                <label>Department <span class="login-danger">*</span></label>
                                                {!! Form::select('department_id', [], null, ['class' => 'form-control select', 'id' => 'department_id']) !!}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-3">
                                            <div class="form-group local-forms cal-icon">
                                                <label>Date <span class="login-danger">*</span></label>
                                                <input class="form-control datetimepicker" type="text" placeholder=""
                                                    name="appoinment_date" id="appoinment_date" value="">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-3">
                                            <div class="form-group local-forms">
                                                <label>Visit <span class="login-danger">*</span></label>
                                                {!! Form::select('visit_id', Config::get('constants.visit'), $data->visit_id, [
                                                    'class' => 'form-control select',
                                                    'id' => 'visit_id',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-3">
                                            <div class="form-group local-forms">
                                                <label>Illness</label>
                                                {!! Form::select('illness_id', Config::get('constants.illness'), $data->illness_id, [
                                                    'class' => 'form-control select',
                                                    'id' => 'illness_id',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-3">
                                            <div class="form-group local-forms">
                                                <label>Appointment Mode</label>
                                                {!! Form::select('appointment_mode_id', Config::get('constants.appoinment_mode'), $data->appointment_mode_id, [
                                                    'class' => 'form-control select',
                                                    'id' => 'appointment_mode_id',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-3">
                                            <div class="form-group local-forms">
                                                <label>Symptoms</label>
                                                {!! Form::select('symptoms_id', Config::get('constants.symptoms'), $data->symptoms_id, [
                                                    'class' => 'form-control select',
                                                    'id' => 'symptoms_id',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if (Auth::user()->type == 1 && $data->status == 'A')
                                <div class="card-box">
                                    <h3 class="card-title">Add Prescription</h3>
                                    <hr>
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-hover mb-0" id="add_prescription">
                                                <thead>
                                                <tr>
                                                    <th>Medicine Name</th>
                                                    <th>Type</th>
                                                    <th style="width: 75px;">Days</th>
                                                    <th style="width: 75px;">AF/BF</th>
                                                    <th style="width: 65px;">Morning</th>
                                                    <th style="width: 65px;">Afternoon</th>
                                                    <th style="width: 65px;">Evening</th>
                                                    <th style="width: 65px;">Night</th>
                                                    <th>Remarks</th>
                                                    <th><div class="action_container">
                                                        <span class="success" onclick="create_tr('table_body')">
                                                        <i class="fa fa-plus"></i>
                                                        </span>
                                                    </div></th>
                                                </tr>
                                                <tbody id="table_body">
                                                    @if (isset($data->patientprescription) && count($data->patientprescription) >0 )
                                                     @foreach ($data->patientprescription as $prescription)
                                                        <tr>
                                                            <td><input type="text" id="medicine_id" name="medicine_id[]" class="form-control medicinesearch add_prescription" value="{{$prescription->medicien->name}}"></td>
                                                            <td>{!! Form::select('medicine_type_id[]', Config::get('constants.medicine_type'), $prescription->medicine_type_id, ['class' => 'form-control']) !!}</td>
                                                            <td><input class="form-control add_prescription" type="text"name="days[]" value="{{$prescription->days}}"></td>
                                                            <td><input class="form-control add_prescription" type="text" name="af_bf[]" value="{{$prescription->af_bf}}"></td>
                                                            <td><input class="form-control add_prescription" type="text" name="morning[]" value="{{$prescription->morning}}"></td>
                                                            <td><input class="form-control add_prescription" type="text" name="afternoon[]" value="{{$prescription->afternoon}}"></td>
                                                            <td><input class="form-control add_prescription" type="text" name="evening[]" value="{{$prescription->evening}}"></td>
                                                            <td><input class="form-control add_prescription" type="text" name="night[]" value="{{$prescription->night}}"></td>
                                                            <td><input class="form-control add_prescription" type="text" name="remarks[]" value="{{$prescription->remarks}}"></td>
                                                            <td><div class="action_container">
                                                                <span class="danger" onclick="remove_tr(this)">
                                                                <i class="fa fa-close"></i>
                                                                </span>
                                                            </div></td>
                                                        </tr>
                                                     @endforeach
                                                    @else
                                                        <tr>
                                                            <td><input type="text" id="medicine_id" name="medicine_id[]" class="form-control medicinesearch add_prescription"></td>
                                                            <td>{!! Form::select('medicine_type_id[]', Config::get('constants.medicine_type'), null, ['class' => 'form-control']) !!}</td>
                                                            <td><input class="form-control add_prescription" type="text"name="days[]" value=""></td>
                                                            <td><input class="form-control add_prescription" type="text" name="af_bf[]" value=""></td>
                                                            <td><input class="form-control add_prescription" type="text" name="morning[]" value=""></td>
                                                            <td><input class="form-control add_prescription" type="text" name="afternoon[]" value=""></td>
                                                            <td><input class="form-control add_prescription" type="text" name="evening[]" value=""></td>
                                                            <td><input class="form-control add_prescription" type="text" name="night[]" value=""></td>
                                                            <td><input class="form-control add_prescription" type="text" name="remarks[]" value=""></td>
                                                            <td><div class="action_container">
                                                                <span class="danger" onclick="remove_tr(this)">
                                                                <i class="fa fa-close"></i>
                                                                </span>
                                                            </div></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" id="medicine_id" name="medicine_id[]" class="form-control medicinesearch add_prescription"></td>
                                                            <td>{!! Form::select('medicine_type_id[]', Config::get('constants.medicine_type'), null, ['class' => 'form-control']) !!}</td>
                                                            <td><input class="form-control add_prescription" type="text"name="days[]" value=""></td>
                                                            <td><input class="form-control add_prescription" type="text" name="af_bf[]" value=""></td>
                                                            <td><input class="form-control add_prescription" type="text" name="morning[]" value=""></td>
                                                            <td><input class="form-control add_prescription" type="text" name="afternoon[]" value=""></td>
                                                            <td><input class="form-control add_prescription" type="text" name="evening[]" value=""></td>
                                                            <td><input class="form-control add_prescription" type="text" name="night[]" value=""></td>
                                                            <td><input class="form-control add_prescription" type="text" name="remarks[]" value=""></td>
                                                            <td><div class="action_container">
                                                                <span class="danger" onclick="remove_tr(this)">
                                                                <i class="fa fa-close"></i>
                                                                </span>
                                                            </div></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" id="medicine_id" name="medicine_id[]" class="form-control medicinesearch add_prescription"></td>
                                                            <td>{!! Form::select('medicine_type_id[]', Config::get('constants.medicine_type'), null, ['class' => 'form-control']) !!}</td>
                                                            <td><input class="form-control add_prescription" type="text"name="days[]" value=""></td>
                                                            <td><input class="form-control add_prescription" type="text" name="af_bf[]" value=""></td>
                                                            <td><input class="form-control add_prescription" type="text" name="morning[]" value=""></td>
                                                            <td><input class="form-control add_prescription" type="text" name="afternoon[]" value=""></td>
                                                            <td><input class="form-control add_prescription" type="text" name="evening[]" value=""></td>
                                                            <td><input class="form-control add_prescription" type="text" name="night[]" value=""></td>
                                                            <td><input class="form-control add_prescription" type="text" name="remarks[]" value=""></td>
                                                            <td><div class="action_container">
                                                                <span class="danger" onclick="remove_tr(this)">
                                                                <i class="fa fa-close"></i>
                                                                </span>
                                                            </div></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" id="medicine_id" name="medicine_id[]" class="form-control medicinesearch add_prescription"></td>
                                                            <td>{!! Form::select('medicine_type_id[]', Config::get('constants.medicine_type'), null, ['class' => 'form-control']) !!}</td>
                                                            <td><input class="form-control add_prescription" type="text"name="days[]" value=""></td>
                                                            <td><input class="form-control add_prescription" type="text" name="af_bf[]" value=""></td>
                                                            <td><input class="form-control add_prescription" type="text" name="morning[]" value=""></td>
                                                            <td><input class="form-control add_prescription" type="text" name="afternoon[]" value=""></td>
                                                            <td><input class="form-control add_prescription" type="text" name="evening[]" value=""></td>
                                                            <td><input class="form-control add_prescription" type="text" name="night[]" value=""></td>
                                                            <td><input class="form-control add_prescription" type="text" name="remarks[]" value=""></td>
                                                            <td><div class="action_container">
                                                                <span class="danger" onclick="remove_tr(this)">
                                                                <i class="fa fa-close"></i>
                                                                </span>
                                                            </div></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" id="medicine_id" name="medicine_id[]" class="form-control medicinesearch add_prescription"></td>
                                                            <td>{!! Form::select('medicine_type_id[]', Config::get('constants.medicine_type'), null, ['class' => 'form-control']) !!}</td>
                                                            <td><input class="form-control add_prescription" type="text"name="days[]" value=""></td>
                                                            <td><input class="form-control add_prescription" type="text" name="af_bf[]" value=""></td>
                                                            <td><input class="form-control add_prescription" type="text" name="morning[]" value=""></td>
                                                            <td><input class="form-control add_prescription" type="text" name="afternoon[]" value=""></td>
                                                            <td><input class="form-control add_prescription" type="text" name="evening[]" value=""></td>
                                                            <td><input class="form-control add_prescription" type="text" name="night[]" value=""></td>
                                                            <td><input class="form-control add_prescription" type="text" name="remarks[]" value=""></td>
                                                            <td><div class="action_container">
                                                                <span class="danger" onclick="remove_tr(this)">
                                                                <i class="fa fa-close"></i>
                                                                </span>
                                                            </div></td>
                                                        </tr>
                                                    @endif

                                                </tbody>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="col-12">
                                    <div class="doctor-submit text-center" style="margin-top: 10px">
                                        <button type="submit" class="btn btn-primary submit-btn">Update</button>
                                        <button type="submit" class="btn btn-primary cancel-form cancel" onclick="window.history.go(-1); return false;">Cancel</button>
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
    .ui-autocomplete {
        z-index: 9999 !important;
    }
    .form_control {
        border: 1px solid #0002;
        background-color: transparent;
        outline: none;
        padding: 8px 12px;
        font-family: 1.2rem;
        width: 100%;
        color: #333;
        font-family: Arial, Helvetica, sans-serif;
        transition: 0.3s ease-in-out;
    }
    /* form field design end */


    .success {
        background-color: #24b96f !important;
        font-size: 12px;
    }

    .warning {
        background-color: #ebba33 !important;
        font-size: 12px;
    }

    .primary {
        background-color: #259dff !important;
        font-size: 12px;
    }

    .secondery {
        background-color: #00bcd4 !important;
        font-size: 12px;
    }

    .danger {
        background-color: #ff5722 !important;
        font-size: 12px;
    }

    .action_container {
        display: inline-flex;
    }

    .action_container>* {
        border: none;
        outline: none;
        color: #fff;
        text-decoration: none;
        display: inline-block;
        padding: 4px 8px;
        cursor: pointer;
        transition: 0.3s ease-in-out;
    }

    .action_container>*+* {
        border-left: 1px solid #fff5;
    }

    .action_container>*:hover {
        filter: hue-rotate(-20deg) brightness(0.97);
        transform: scale(1.05);
        border-color: transparent;
        box-shadow: 0 2px 10px #0004;
        border-radius: 2px;
    }

    .action_container>*:active {
        transition: unset;
        transform: scale(.95);
    }
    table#prescriptionViewData>thead>tr>th, table#prescriptionViewData>tbody>tr>td{
        font-size: 12px;
    }
.table>thead>tr>th {
    font-size: 14px;
    line-height: 15px;
    text-align: center;
}
.table>tbody>tr {
    font-size: 14px;
    line-height: 15px;
}
.add_prescription {
    max-height: 35px !important;
    min-height: 35px !important;
}
select.form-control{
    min-height: 30px !important;
    line-height: 1 !important;
}
</style>
<script>
    $(document).ready(function($) {
        var stateId = "{{ isset($data->state_id) ? $data->state_id : 0 }}";
        var cityId = "{{ isset($data->city_id) ? $data->city_id : 0 }}";

        var doctorId = "{{ isset($data->doctor_id) ? $data->doctor_id : '' }}";
        var departId = "{{ isset($data->department_id) ? $data->department_id : '' }}";

        var dob = "{{ $data && $data->date_of_birth ? date('m/d/Y', strtotime($data->date_of_birth)) : '' }}";
        $('#date_of_birth').val(dob);

        var appoinment_date =
            "{{ $data && $data->appoinment_date ? date('m/d/Y', strtotime($data->appoinment_date)) : '' }}";
        $('#appoinment_date').val(appoinment_date);

        $('#date_of_birth').datetimepicker({
            "format": 'DD/MM/YYYY'
        }).on('dp.change', function(e) {
            var dob = $('#date_of_birth').val();
            console.log(dob)
            if (dob != '') {
                var age = moment().diff(moment(dob, 'DD/MM/YYYY'), 'years');
                $('#age').val(age);
            }
        });
        $('#aadhar_number').keyup(function() {
            var value = $(this).val();
            value = value.replace(/\D/g, "").split(/(?:([\d]{4}))/g).filter(s => s.length > 0).join(
            "-");
            $(this).val(value);
        });

        $("#weight, #height").keyup(function() {
            var weight = $('input[name=weight]').val();
            var height = $('input[name=height]').val();
            var bmi = weight / (height / 100 * height / 100);
            $('#bmi').val(isNaN(parseInt(bmi)) ? '' : parseInt(bmi));
            bmiCategory(bmi)
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
        $('#state_id').on('change', function() {
            var idState = this.value;
            $("#city_id").html('');
            $.ajax({
                url: "{{ url('fetch-cities') }}",
                type: "POST",
                data: {
                    state_id: idState,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#city_id').html('<option value="">Select City</option>');
                    $.each(res.cities, function(key, value) {
                        $("#city_id").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });
        $('#doctor_id').on('change', function() {
            var idState = this.value;
            $("#department_id").html('');
            $.ajax({
                url: "{{ url('fetch-department') }}",
                type: "POST",
                data: {
                    doctor_id: idState,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    // $('#city').html('<option value="">Select City</option>');
                    $.each(res.department, function(key, value) {
                        $("#department_id").append('<option value="' + value
                            .id + '">' + value.department_name + '</option>');
                    });
                }
            });
        });
        selectCity(stateId, cityId);
        selectDepartment(doctorId, departId);
        autocomplete();
    });

function selectCity(state_id, city_id) {
    $.ajax({
        url: "{{ url('fetch-cities') }}",
        type: "POST",
        data: {
            state_id: state_id,
            _token: '{{ csrf_token() }}'
        },
        dataType: 'json',
        success: function(res) {
            $('#city_id').html('<option value="">Select City</option>');
            $.each(res.cities, function(key, value) {
                $("#city_id").append('<option value="' + value
                    .id + '">' + value.name + '</option>');
            });
            $('#city_id').val(city_id)
        }
    });
}

function selectDepartment(doctor_id, department_id) {
    $.ajax({
        url: "{{ url('fetch-department') }}",
        type: "POST",
        data: {
            doctor_id: doctor_id,
            _token: '{{ csrf_token() }}'
        },
        dataType: 'json',
        success: function(res) {
            $.each(res.department, function(key, value) {
                $("#department_id").append('<option value="' + value
                    .id + '">' + value.department_name + '</option>');
            });
            $('#department_id').val(department_id)
        }
    });
}
function bmiCategory(bmi){
    var output='';
    if (bmi <= 18.5) {
        output = "UNDERWEIGHT";
    } else if (bmi > 18.5 && bmi<=24.9 ) {
        output = "NORMAL WEIGHT";
    } else if (bmi > 24.9 && bmi<=29.9) {
        output = "OVERWEIGHT";
    } else if (bmi > 30.0) {
        output = "OBESE";
    }
    $("#bmicategory").text(output);
}
function create_tr(table_id) {
    let table_body = document.getElementById(table_id),
        first_tr   = table_body.firstElementChild
        last_tr   = table_body.lastElementChild
        tr_clone   = last_tr.cloneNode(true);
        table_body.append(tr_clone);
    // clean_first_tr(table_body.lastElementChild);
    autocomplete();
}
function remove_tr(This) {
    if(This.closest('tbody').childElementCount == 1)
    {
        alert("You Don't have Permission to Delete This ?");
    }else{
        This.closest('tr').remove();
    }
}
function clean_first_tr(firstTr) {
    let children = firstTr.children;

    children = Array.isArray(children) ? children : Object.values(children);
    children.forEach(x=>{
        if(x !== firstTr.lastElementChild)
        {
            x.firstElementChild.value = '';
        }
    });
}
function autocomplete(){
    $( '.medicinesearch' ).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "{{url('appointment/mediciensearch')}}",
                data:{
                    term : request.term
                },
                dataType: "json",
                success: function(data){
                    console.log(data);
                    var resp = $.map(data,function(obj){
                        return obj.name;
                    });
                    response(resp);
                }
            });
        },
        minLength: 1
    });
}
</script>
@endsection
