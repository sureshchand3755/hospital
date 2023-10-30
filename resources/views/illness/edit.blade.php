<?php $page="doctor";?>
@extends('layout.mainlayout')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-12">

                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{url('illness/update')}}" id="edit_illness">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-heading">
                                        <h4>Edit Illness</h4>
                                    </div>
                                </div>
                                <input type="text" id="illness_id" name="id" value="{{$data->id}}" style="display: none">
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label>Name <span class="login-danger">*</span></label>
                                        <input class="form-control" type="text" id="name" name="name" value="{{ isset($data->name)? $data->name:''}}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6"></div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label>Description</label>
                                        <textarea class="form-control" rows="3" cols="30"id="desc" name="desc">{{ isset($data->desc)? $data->desc:''}}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6"></div>
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
    var id = $('#illness_id').val();
    checkUrl = "{{ route('illness.check', ':id') }}";
    checkUrl = checkUrl.replace(':id', id);
        $("#edit_illness").validate({
            rules: {
                name: {
                    required: true,
                    remote: checkUrl
                },
                desc: "required",
                status: "required"
            },
            // Specify validation error messages
            messages: {
                name: {
                    required :"Please enter your name",
                    remote : "Illness Name is already exists",
                },
                desc: "Please enter your description",
                status: "Please select status",
            },
            submitHandler: function(form) {
                form.submit();
            }
        });


    });
</script>
@endsection

