<?php $page = 'index'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        @include('layout.partials.flash-message')
        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    <form method="POST" action="{{ route('patient.profile') }}" id="update_profile"  enctype="multipart/form-data">
                        @csrf
                        <div class="card-box">
                            <h3 class="card-title">General Details</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="profile-img-wrap">
                                        <img class="inline-block" src="{{ $PatientGeneralInfo && $PatientGeneralInfo->profile_image ? asset('images/'.$PatientGeneralInfo->profile_image) : URL::asset('assets/img/user.jpg') }}" alt="user">
                                        <div class="fileupload btn">
                                            <span class="btn-text">edit</span>
                                            <input class="upload" type="file" name="profile_image" id="profile_image">
                                        </div>
                                    </div>
                                    <div class="profile-basic">
                                        <div class="row">
                                            <div class="col-12 col-md-6 col-xl-6">
                                                <div class="form-group local-forms">
                                                    <label>Subtitle</label>
                                                    <input class="form-control" type="text" placeholder="" name="subtitle"
                                                        id="subtitle"
                                                        value="{{ $PatientGeneralInfo && $PatientGeneralInfo->subtitle ? $PatientGeneralInfo->subtitle : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-6">
                                                <div class="form-group local-forms">
                                                    <label>Patient Name <span class="login-danger">*</span></label>
                                                    <input class="form-control" type="text" placeholder="" name="patient_name"
                                                        id="patient_name"
                                                        value="{{ $PatientGeneralInfo && $PatientGeneralInfo->patient_name ? $PatientGeneralInfo->patient_name : '' }}">
                                                        <x-input-error :messages="$errors->get('patient_name')" class="mt-2  text-danger" />
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
                                                    <input class="form-control" type="text" placeholder="" name="age"
                                                        id="age"
                                                        value="{{ $PatientGeneralInfo && $PatientGeneralInfo->age ? $PatientGeneralInfo->age : '' }}">
                                                        <x-input-error :messages="$errors->get('age')" class="mt-2  text-danger" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-4">
                                                <div class="form-group select-gender">
                                                    <label class="gen-label">Gender<span class="login-danger">*</span></label>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" name="gender" class="form-check-input"
                                                                value="male"
                                                                {{ $PatientGeneralInfo && $PatientGeneralInfo->gender == 'male' ? 'checked' : '' }}>Male
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" name="gender" class="form-check-input"
                                                                value="female"
                                                                {{ $PatientGeneralInfo && $PatientGeneralInfo->gender == 'female' ? 'checked' : '' }}>Female
                                                        </label>
                                                    </div>
                                                    <x-input-error :messages="$errors->get('gender')" class="mt-2  text-danger" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-4">
                                                <div class="form-group local-forms">
                                                    <label>Aadhar</label>
                                                    <input class="form-control" type="text" placeholder="" name="aadhar_number"
                                                        id="aadhar_number"
                                                        value="{{ $PatientGeneralInfo && $PatientGeneralInfo->aadhar_number ? $PatientGeneralInfo->aadhar_number : '' }}" maxLength="19">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-3">
                                                <div class="form-group select-gender">
                                                    <label class="gen-label"></label>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" name="father_or_husband" class="form-check-input"
                                                                value="F"
                                                                {{ $PatientGeneralInfo && $PatientGeneralInfo->father_or_husband == 'F' ? 'checked' : '' }}>Father
                                                            /
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" name="father_or_husband" class="form-check-input"
                                                                value="H"
                                                                {{ $PatientGeneralInfo && $PatientGeneralInfo->father_or_husband == 'H' ? 'checked' : '' }}>Husband
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
                                                        value="{{ $PatientGeneralInfo && $PatientGeneralInfo->father_or_husband_name ? $PatientGeneralInfo->father_or_husband_name : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-3">
                                                <div class="form-group select-gender">
                                                    <label class="gen-label"></label>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" name="mother_or_wife" class="form-check-input"
                                                                value="M"
                                                                {{ $PatientGeneralInfo && $PatientGeneralInfo->mother_or_wife == 'M' ? 'checked' : '' }}>Mother
                                                            /
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" name="mother_or_wife" class="form-check-input"
                                                                value="W"
                                                                {{ $PatientGeneralInfo && $PatientGeneralInfo->mother_or_wife == 'W' ? 'checked' : '' }}>Wife
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-5">
                                                <div class="form-group local-forms">
                                                    <label></label>
                                                    <input class="form-control" type="text" placeholder="Enter Mother / Wife Name"
                                                        name="mother_or_wife_name" id="mother_or_wife_name"
                                                        value="{{ $PatientGeneralInfo && $PatientGeneralInfo->mother_or_wife_name ? $PatientGeneralInfo->mother_or_wife_name : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-xl-4">
                                                <div class="form-group local-forms">
                                                    <label>Guardian Name</label>
                                                    <input class="form-control" type="text" placeholder="" name="guardian_name"
                                                        id="guardian_name"
                                                        value="{{ $PatientGeneralInfo && $PatientGeneralInfo->guardian_name ? $PatientGeneralInfo->guardian_name : '' }}">
                                                </div>
                                            </div>
                                        </div>
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
                                        <textarea class="form-control" rows="2" cols="15" name="address" id="address">{{ $PatientContactInfo && $PatientContactInfo->address ? $PatientContactInfo->address : '' }}</textarea>
                                        <x-input-error :messages="$errors->get('address')" class="mt-2  text-danger" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="form-group local-forms">
                                        <label>State/Province <span class="login-danger">*</span></label>
                                        <select class="form-control select" name="state" id="state">
                                            <option value="">Select State</option>
                                            @foreach ($states as $data)
                                                <option
                                                    {{ $PatientContactInfo && $PatientContactInfo->state == $data->id ? 'selected' : '' }}
                                                    value="{{ $data->id }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('state')" class="mt-2  text-danger" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="form-group local-forms">
                                        <label>City <span class="login-danger">*</span></label>
                                        <select class="form-control select" name="city" id="city">
                                        </select>
                                        <x-input-error :messages="$errors->get('city')" class="mt-2  text-danger" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="form-group local-forms">
                                        <label>Postal Code <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" placeholder="" name="postal_code"
                                            id="postal_code"
                                            value="{{ $PatientContactInfo && $PatientContactInfo->postal_code ? $PatientContactInfo->postal_code : '' }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="form-group local-forms">
                                        <label>Phone <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" placeholder="" name="phone_number"
                                            id="phone_number"
                                            value="{{ $PatientContactInfo && $PatientContactInfo->phone_number ? $PatientContactInfo->phone_number : '' }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="form-group local-forms">
                                        <label>Education</label>
                                        <input class="form-control" type="text" placeholder="" name="education"
                                            id="education"
                                            value="{{ $PatientContactInfo && $PatientContactInfo->education ? $PatientContactInfo->education : '' }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="form-group local-forms">
                                        <label>Ref.By</label>
                                        <input class="form-control" type="text" placeholder="" name="ref_by"
                                            id="ref_by"
                                            value="{{ $PatientContactInfo && $PatientContactInfo->ref_by ? $PatientContactInfo->ref_by : '' }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="form-group local-forms">
                                        <label>Occupation</label>
                                        <input class="form-control" type="text" placeholder="" name="occupation"
                                            id="occupation"
                                            value="{{ $PatientContactInfo && $PatientContactInfo->occupation ? $PatientContactInfo->occupation : '' }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="form-group select-gender">
                                        <label class="gen-label"></label>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="send_alert" id="send_alert"
                                                    class="form-check-input" value="Y"
                                                    {{ $PatientContactInfo && $PatientContactInfo->send_alert == 'Y' ? 'checked' : '' }}>Send
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
                                            value="{{ $PatientMedicalInfo && $PatientMedicalInfo->blood ? $PatientMedicalInfo->blood : '' }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="form-group local-forms">
                                        <label>Diet</label>
                                        <input class="form-control" type="text" placeholder="" name="diet"
                                            id="diet"
                                            value="{{ $PatientMedicalInfo && $PatientMedicalInfo->diet ? $PatientMedicalInfo->diet : '' }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="form-group local-forms">
                                        <label>Height</label>
                                        <input class="form-control" type="text" placeholder="" name="height"
                                            id="height"
                                            value="{{ $PatientMedicalInfo && $PatientMedicalInfo->height ? $PatientMedicalInfo->height : '' }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-3">
                                    <div class="form-group local-forms">
                                        <label>Weight</label>
                                        <input class="form-control" type="text" placeholder="" name="weight"
                                            id="weight"
                                            value="{{ $PatientMedicalInfo && $PatientMedicalInfo->weight ? $PatientMedicalInfo->weight : '' }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-2">
                                    <div class="form-group local-forms">
                                        <label>Birth Wgt</label>
                                        <input class="form-control" type="text" placeholder="" name="brith_weight"
                                            id="brith_weight"
                                            value="{{ $PatientMedicalInfo && $PatientMedicalInfo->brith_weight ? $PatientMedicalInfo->brith_weight : '' }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-5">
                                    <div class="form-group local-forms">
                                        <label>Allergic to any Mediciens / Any Medical Conditions</label>
                                        <textarea class="form-control" rows="2" cols="15" name="any_mediciens" id="any_mediciens">{{ $PatientMedicalInfo && $PatientMedicalInfo->any_mediciens ? $PatientMedicalInfo->any_mediciens : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-5">
                                    <div class="form-group local-forms">
                                        <label>Note</label>
                                        <textarea class="form-control" rows="2" cols="15" name="note" id="note">{{ $PatientMedicalInfo && $PatientMedicalInfo->note ? $PatientMedicalInfo->note : '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="doctor-submit text-center">
                            <button type="submit"
                                class="btn btn-primary submit-btn mb-4">{{ $PatientGeneralInfo && $PatientGeneralInfo->user_id ? 'Update' : 'Submit' }}</button>
                            <button type="submit" class="btn btn-primary cancel-form  mb-4">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
    <script>
        $(document).ready(function() {
            var dob = "{{ $PatientGeneralInfo && $PatientGeneralInfo->date_of_birth ? date('m/d/Y', strtotime($PatientGeneralInfo->date_of_birth)) : '' }}";
            $('#date_of_birth').val(dob);

            var stateId = "{{ $PatientContactInfo && $PatientContactInfo->state?$PatientContactInfo->state:''}}";
            var cityId = "{{ $PatientContactInfo && $PatientContactInfo->city?$PatientContactInfo->city:''}}";

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

            $('#state').on('change', function () {
                    var idState = this.value;
                    $("#city").html('');
                    $.ajax({
                        url: "{{url('fetch-cities')}}",
                        type: "POST",
                        data: {
                            state_id: idState,
                            _token: '{{csrf_token()}}'
                        },
                        dataType: 'json',
                        success: function (res) {
                            $('#city').html('<option value="">Select City</option>');
                            $.each(res.cities, function (key, value) {
                                $("#city").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                        }
                    });
                });
                $("#update_profile").validate({
                    // Specify validation rules
                    rules: {
                        patient_name: "required",
                        date_of_birth: "required",
                        age: "required",
                        gender: "required",
                        address: "required",
                        state: "required",
                        city: "required",
                        postal_code: "required",
                        phone_number: "required"
                    },
                    // Specify validation error messages
                    messages: {
                        patient_name: "Please enter patient name",
                        date_of_birth: "Please select date of birth",
                        age: "Please enter age",
                        gender: "Please select gender",
                        address: "Please enter address",
                        state: "Please select state",
                        city: "Please select city",
                        postal_code: "Please enter postal code",
                        phone_number: "Please enter phone number",
                    },
                    errorPlacement: function(error, element) {
                        var placement = $(element).data('error');
                        if (placement) {
                            $(placement).append(error)
                        } else {
                            error.insertAfter(element);
                        }
                    },
                    submitHandler: function(form) {
                        form.submit();
                    }
                });
selectCity(stateId, cityId);
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
            $('#city').html('<option value="">Select City</option>');
            $.each(res.cities, function (key, value) {
                $("#city").append('<option value="' + value
                    .id + '">' + value.name + '</option>');
            });
            $('#city').val(city_id)
        }
    });
}
</script>
@endsection
