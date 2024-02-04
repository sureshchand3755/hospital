<?php $page="doctor";?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-12">

                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{url('department/store')}} " id="add_department">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-heading">
                                        <h4>Add Department</h4>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label >Department Name <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" id="department_name" name="department_name" data-error="#department_name_error">
                                        <span id="department_name_error"></span>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label >Department Head <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" id="department_head" name="department_head">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12">
                                    <div class="form-group local-forms">
                                        <label>Description  <span class="login-danger">*</span></label>
                                        <textarea class="form-control" rows="3" cols="30"id="department_desc" name="department_desc"></textarea>
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
                                                <input type="radio" id="status" name="status" class="form-check-input" value="0">Active
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
                                        <button type="submit" class="btn btn-primary submit-form me-2">Create</button>
                                        <button type="submit" class="btn btn-primary cancel-form cancel" onclick="window.history.go(-1); return false;">Cancel</button>
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
    var id = 0;
    departmenturl = "{{ route('admin.department.check-department', ':id') }}";
    departmenturl = departmenturl.replace(':id', id);
    // console.log(url);
    $("#add_department").validate({
        // Specify validation rules
        rules: {
            department_name: {
                required: true,
                remote: departmenturl
            },
            department_head: "required",
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
            department_head: "Please enter your department head",
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

