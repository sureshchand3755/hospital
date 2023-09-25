<?php $page="doctor";?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-12">

                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{(Auth::user()->type==0)?url('department/update'):url('admin/department/update')}}" id="edit_department">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-heading">
                                        <h4>Edit Department</h4>
                                    </div>
                                </div>
                                <input type="text" id="department_id" name="id" value="{{$data->id}}" style="display: none">
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label >Department Name <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" id="department_name" name="department_name" value="{{ isset($data->department_name)? $data->department_name:''}}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label >Department Head </label>
                                        <input class="form-control" type="text" id="department_head" name="department_head" value="{{ isset($data->department_head)? $data->department_head:''}}">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12">
                                    <div class="form-group local-forms">
                                        <label>Description  <span class="login-danger">*</span></label>
                                        <textarea class="form-control" rows="3" cols="30"id="department_desc" name="department_desc">{{ isset($data->department_desc)? $data->department_desc:''}}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms cal-icon">
                                        <label >Department Date  <span class="login-danger">*</span></label>
                                        <input class="form-control datetimepicker" type="text" id="department_date" name="department_date" >
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group select-gender">
                                        <label class="gen-label" for="status">Status <span class="login-danger">*</span></label>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" id="status" name="status" class="form-check-input" value="0" {{$data && $data->status==0?'checked':''}}>Active
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" id="status" name="status" class="form-check-input" value="1" {{$data && $data->status==1?'checked':''}}>In Active
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="doctor-submit text-center">
                                        <button type="submit" class="btn btn-primary submit-form me-2">Update</button>
                                        <button type="button" class="btn btn-primary cancel-form cancel" onclick="window.history.go(-1); return false;">Cancel</button>
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
    $(function () {
    var dob = "{{ isset($data->department_date)? date('d/m/Y', strtotime($data->department_date)) : '' }}";
    $('#department_date').val(dob);

    var id = $('#department_id').val();
    departmenturl = "{{ route('admin.department.check-department', ':id') }}";
    departmenturl = departmenturl.replace(':id', id);
        $("#edit_department").validate({
            rules: {
                department_name: {
                    required: true,
                    remote: departmenturl
                },
                department_desc: "required",
                department_date: "required",
                status: "required"
            },
            // Specify validation error messages
            messages: {
                department_name: {
                    required :"Please enter your department name",
                    remote : "Department Name is already exists",
                },
                department_desc: "Please enter your description",
                department_date: "Please select date",
                status: "Please select status",
            },
            submitHandler: function(form) {
                form.submit();
            }
        });


    });
</script>
@endsection

