<?php $page="doctor";?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-12">

                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{url('medicien/store')}} " id="add_medicien">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-heading">
                                        <h4>Add Medicien</h4>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label>Name <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" id="name" name="name">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6"></div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label>Description</label>
                                        <textarea class="form-control" rows="3" cols="30"id="desc" name="desc"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6"></div>
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
    url = "{{ route('medicien.check', ':id') }}";
    url = url.replace(':id', id);
    $("#add_medicien").validate({
        // Specify validation rules
        rules: {
            name: {
                required: true,
                remote: url
            },
            status: "required"
        },
        // Specify validation error messages
        messages: {
            name: {
                required :"Please enter your name",
                remote : "Medicien Name is already exists",
            },
            status: "Please select status",
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
</script>
@endsection

