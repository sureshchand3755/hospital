<?php $page="appointments";?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        @include('layout.partials.flash-message')
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table show-entire">
                    <div class="card-body">
                        <!-- Table Header -->
                        <div class="page-table-header mb-2">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="doctor-table-blk">
                                        <h3>Appointment List</h3>
                                        <div class="doctor-search-blk">
                                            {{-- <div class="top-nav-search table-search-blk">
                                                <form>
                                                    <input type="text" class="form-control" placeholder="Search here">
                                                    <a class="btn"><img src="../assets/img/icons/search-normal.svg" alt=""></a>
                                                </form>
                                            </div> --}}
                                            <div class="add-group">
                                                @if (Auth::user()->type==0)
                                                <a href="{{url('appointment/add')}}" class="btn btn-primary add-pluss ms-2" title="Add"><img src="{{URL::asset('/assets/img/icons/plus.svg')}}" alt=""></a>
                                                @endif
                                                {{-- <a href="javascript:;" class="btn btn-primary doctor-refresh ms-2" title="Refresh"><img src="{{URL::asset('/assets/img/icons/re-fresh.svg')}}" alt=""></a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="javascript:;" class=" me-2"><img src="assets/img/icons/pdf-icon-01.svg" alt=""></a>
                                    <a href="javascript:;" class=" me-2"><img src="assets/img/icons/pdf-icon-02.svg" alt=""></a>
                                    <a href="javascript:;" class=" me-2"><img src="assets/img/icons/pdf-icon-03.svg" alt=""></a>
                                    <a href="javascript:;" ><img src="assets/img/icons/pdf-icon-04.svg" alt=""></a>

                                </div> --}}
                            </div>
                        </div>
                        <!-- /Table Header -->

                        <div class="table-responsive">
                            @if (Auth::user()->type==0)
                            <table class="table border-0 custom-table comman-table datatable mb-0" id="appointments_list">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </th>
                                        <th>#No</th>
                                        <th>Patient Name</th>
                                        <th>DOB</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Phone No.</th>
                                        <th>Consulting Doctor</th>
                                        <th>Department</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            @else
                            <table class="table border-0 custom-table comman-table datatable mb-0" id="booking_lists">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </th>
                                        <th>#No</th>
                                        <th>Patient Name</th>
                                        <th>DOB</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Phone No.</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- View Patient Modal -->
<div class="modal fade" id="view_appointment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 50%">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">Patient Details - <span id="appno"> </span> </h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="card-box">
                            <h4 class="card-title">General Details</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>Subtitle</strong></label>
                                        <div class="col-md-8">
                                            <span id="v_subtitle" class="viewtext"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>Phone</strong></label>
                                        <div class="col-md-8">
                                            <span id="v_phone" class="viewtext"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>Dob</strong></label>
                                        <div class="col-md-8">
                                            <span id="v_dob" class="viewtext"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>Gender</strong></label>
                                        <div class="col-md-8">
                                            <span id="v_gender" class="viewtext"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row father">
                                        <label class="col-md-4 col-form-label"><strong>Father</strong></label>
                                        <div class="col-md-8">
                                            <span id="v_father" class="viewtext"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row husband">
                                        <label class="col-md-4 col-form-label"><strong>Husband</strong></label>
                                        <div class="col-md-8">
                                            <span id="v_husband" class="viewtext"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>Guardian</strong></label>
                                        <div class="col-md-8">
                                            <span id="v_guardian" class="viewtext"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>Patient Name</strong></label>
                                        <div class="col-md-8">
                                            <span id="v_patientname" class="viewtext"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>Email</strong></label>
                                        <div class="col-md-8">
                                            <span id="v_email" class="viewtext"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>Age</strong></label>
                                        <div class="col-md-8">
                                            <span id="v_age" class="viewtext"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>Aadhar</strong></label>
                                        <div class="col-md-8">
                                            <span id="v_aadhar" class="viewtext"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row mother">
                                        <label class="col-md-4 col-form-label"><strong>Mother</strong></label>
                                        <div class="col-md-8">
                                            <span id="v_mother" class="viewtext"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row wife">
                                        <label class="col-md-4 col-form-label"><strong>Wife</strong></label>
                                        <div class="col-md-8">
                                            <span id="v_wife" class="viewtext"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-box">
                            <h4 class="card-title">Contact Details</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>Address</strong></label>
                                        <div class="col-md-8">
                                            <span id="v_adress" class="viewtext"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>City</strong></label>
                                        <div class="col-md-8">
                                            <span id="v_city" class="viewtext"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>Education</strong></label>
                                        <div class="col-md-8">
                                            <span id="v_education" class="viewtext"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>Occupation</strong></label>
                                        <div class="col-md-8">
                                            <span id="v_occupation" class="viewtext"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>State</strong></label>
                                        <div class="col-md-8">
                                            <span id="v_state" class="viewtext"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>Postal Code</strong></label>
                                        <div class="col-md-8">
                                            <span id="v_postalcode" class="viewtext"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>Ref.By</strong></label>
                                        <div class="col-md-8">
                                            <span id="v_refby" class="viewtext"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>Send Alert</strong></label>
                                        <div class="col-md-8">
                                            <span id="v_sendalert" class="viewtext"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-box">
                            <h4 class="card-title">Medical Details</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>Blood</strong></label>
                                        <div class="col-md-8">
                                            <span id="v_blood" class="viewtext"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>Height</strong></label>
                                        <div class="col-md-8">
                                            <span id="v_height" class="viewtext"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>Birth Wgt</strong></label>
                                        <div class="col-md-8">
                                            <span id="v_birthwgt" class="viewtext"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>Note</strong></label>
                                        <div class="col-md-8">
                                            <span id="v_note" class="viewtext"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>Diet</strong></label>
                                        <div class="col-md-8">
                                            <span id="v_diet" class="viewtext"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>Weight</strong></label>
                                        <div class="col-md-8">
                                            <span id="v_weight" class="viewtext"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>Mediciens</strong></label>
                                        <div class="col-md-8">
                                            <span id="v_mediciens" class="viewtext"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-box">
                            <h4 class="card-title">Doctor Details</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>Doctor</strong></label>
                                        <div class="col-md-8">
                                            <span id="v_doctor" class="viewtext"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"><strong>Department</strong></label>
                                        <div class="col-md-8">
                                            <span id="v_department" class="viewtext"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-box">
                            <h4 class="card-title">Prescriptions Details</h4>
                            <hr>
                            <div class="row prescriptionData"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
<!-- Delete Patient Modal -->
<div id="delete_appointment" class="modal fade delete-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <form action="{{ route('appointment.delete') }}" method="POST">
                    @csrf
                    <input type="hidden" id="e_id" name="id">
                    <img src="{{URL::asset('assets/img/sent.png')}}" alt="" width="50" height="46">
                    <h3>Are you sure want to delete this ?</h3>
                    <div class="m-t-20"> <a href="#" class="btn btn-white" data-bs-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Prescription Modal -->
<div id="prescription" class="modal fade delete-modal" aria-labelledby="prescriptionModalLabel" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="prescriptionModalLabel">Add Prescription</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('doctor.prescription.add') }}" method="POST" id="add_prescription" enctype="multipart/form-data">
                <div class="modal-body text-center">
                        @csrf
                        <input type="hidden" id="patient_id" name="patient_id" value="">
                        <input type="hidden" id="doctor_id" name="doctor_id" value="">
                        <div class="row">

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function($) {

    var loginType = "{{ Auth::user()->type}}";
    var changeStatusUrl = "{{url('appointment/changestatus')}}";
    if(loginType==1){
        changeStatusUrl = "{{url('doctor/appointment/changestatus')}}";
    }

    $(document).on('click','.delete_appointment',function(){
        var id = $(this).data('id');
        $('#e_id').val(id);
    });

    $("#add_prescription").validate({
        rules: {
            prescription: "required",
        },
        messages: {
            prescription: "Please enter prescription",
        }
    });


    $(document).on('click','.view_appointment',function(){
        var id = $(this).data('id');
        var doctor_id = $(this).data('doctorid');
        var url = "{{ route('patient.appointment.view', ':id') }}";
        if(doctor_id==1){
            url = "{{ route('doctor.appointment.view', ':id') }}";
        }
        url = url.replace(':id', id);
        $.get(url, function (data) {
            $('#appno').text('#'+data.appointment_no);
            $('#v_subtitle').text(data.subtitle);
            $('#v_patientname').text(data.patient_name);
            $('#v_phone').text(data.phone_number);
            $('#v_dob').text(data.date_of_birth);
            $('#v_age').text(data.age);
            $('#v_gender').text(data.gender);
            $('#v_aadhar').text(data.aadhar_number);
            if(data.father_or_husband=="F"){
                $(".husband").hide();
                $(".father").show();
                $('#v_father').text(data.father_or_husband_name);
            }else{
                $(".father").hide();
                $(".husband").show();
                $('#v_husband').text(data.father_or_husband_name);
            }
            if(data.mother_or_wife=="M"){
                $(".wife").hide();
                $(".mother").show();
                $('#v_mother').text(data.mother_or_wife_name);
            }else{
                $(".mother").hide();
                $(".wife").show();
                $('#v_wife').text(data.mother_or_wife_name);
            }
            $('#v_guardian').text(data.guardian_name);

            $('#v_adress').text(data.address);
            $('#v_state').text(data.state.name);
            $('#v_city').text(data.city.name);
            $('#v_name').text(data.postal_code);
            $('#v_email').text(data.education);
            $('#v_mobile').text(data.ref_by);
            $('#v_department').text(data.occupation);
            $('#v_position').text(data.send_alert);
            $('#v_blood').text(data.blood);
            $('#v_diet').text(data.diet);
            $('#v_height').text(data.height);
            $('#v_weight').text(data.weight);
            $('#v_brithwgt').text(data.brith_weight);
            $('#v_mediciens').text(data.any_mediciens);
            $('#v_note').text(data.note);
            $('#v_doctor').text(data.doctordetails.name);
            $('#v_department').text(data.department.department_name);
            if(data.patientprescription.length > 0){
                // var prescription = JSON.stringify(data.patientprescription);
                $.each(data.patientprescription, function(key, presdata) {
                    var insertData = '<div class="col-md-12"><label class="col-md-4 col-form-label"><strong>Doctor Name</strong></label><div class="col-md-8"><span class="viewtext">'+data.doctordetails.name+'</span></div></div><div class="col-md-12"><label class="col-md-4 col-form-label"><strong>Prescription</strong></label><div class="col-md-8"><span class="viewtext">'+presdata.prescriptions+'</span></div></div>';
                    $('.prescriptionData').html(insertData);
                });
            }
        })
    });

    $(document).on('click','.prescription',function(){
        var patient_id = $(this).data('id');
        var doctor_id = $(this).data('doctorid');
        $('#patient_id').val(patient_id);
        $('#doctor_id').val(doctor_id);
    });

    var patientTable = $('#appointments_list').DataTable({
        processing: true,
        responsive: true,
        pageLength: 10,
        lengthMenu: [[10, 20, 25, 50, -1], [10, 20, 25, 50, 'All']],
        serverSide: true,
        ajax: "{{ route('patient.appointment.list') }}",
        columns: [
            {data: 'idRows', name: 'idRows'},
            {data: 'appointment_no', name: 'appointment_no'},
            {data: 'patient_name', name: 'patient_name'},
            {data: 'date_of_birth', name: 'date_of_birth'},
            {data: 'age', name: 'age'},
            {data: 'patient_gender', name: 'patient_gender'},
            {data: 'patient_mobile', name: 'patient_mobile'},
            {data: 'doctor', name: 'doctor'},
            {data: 'department', name: 'department'},
            {data: 'status', name: 'status'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });

    var doctorTable = $('#booking_lists').DataTable({
        processing: true,
        responsive: true,
        pageLength: 10,
        lengthMenu: [[10, 20, 25, 50, -1], [10, 20, 25, 50, 'All']],
        serverSide: true,
        ajax: "{{ route('appointment.list') }}",
        columns: [
            {data: 'idRows', name: 'idRows'},
            {data: 'appointment_no', name: 'appointment_no'},
            {data: 'patient_name', name: 'patient_name'},
            {data: 'date_of_birth', name: 'date_of_birth'},
            {data: 'age', name: 'age'},
            {data: 'patient_gender', name: 'patient_gender'},
            {data: 'patient_mobile', name: 'patient_mobile'},
            {data: 'address', name: 'address'},
            {data: 'status', name: 'status'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });
    $(document).on('change','#status',function(){
        var status = this.value;
        var id = $(this).data('id');
        $.ajax({
            url: changeStatusUrl,
            type: "POST",
            data: {
                id: id,
                status: status,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (res) {
                if(res==1){
                    if(loginType==1){
                        doctorTable.draw();
                    }else{
                        patientTable.draw();
                    }

                }
            }
        });
    });
});
</script>
@endsection
