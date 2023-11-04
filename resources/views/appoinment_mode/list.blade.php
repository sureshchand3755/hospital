<?php $page="doctor";?>
@extends('layout.mainlayout')
@section('content')
 {{-- {!! Toastr::message() !!} --}}
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
                                        <h3>Appoinment Mode List</h3>
                                        <div class="doctor-search-blk">
                                            <div class="add-group">
                                                <a href="{{url('appoinment_mode/add')}}" class="btn btn-primary add-pluss ms-2" title="Add"><img src="{{URL::to('public/assets/img/icons/plus.svg')}}" alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Table Header -->

                        <div class="table-responsive">
                            <table class="table border-0 custom-table comman-table datatable mb-0" id="appoinment_mode_list">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
<!-- View  Modal -->
<div class="modal fade" id="view_appmodes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">View</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label"><strong>Name :</strong></label>
                        <div class="col-md-8">
                            <span id="v_name" class="viewtext"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label"><strong>Description :</strong></label>
                        <div class="col-md-8">
                            <span id="v_desc" class="viewtext"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label"><strong>Status :</strong></label>
                        <div class="col-md-8">
                            <span id="v_status" class="viewtext"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label"><strong>Created Dt. :</strong></label>
                        <div class="col-md-8">
                            <span id="v_created" class="viewtext"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label"><strong>Updated Dt. :</strong></label>
                        <div class="col-md-8">
                            <span id="v_updated" class="viewtext"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
<!-- Delete  Modal -->
<div id="delete_appmodes" class="modal fade delete-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <form action="{{route('appoinment_mode.delete')}}" method="POST">
                    @csrf
                    <input type="hidden" id="e_id" name="id">
                    <img src="assets/img/sent.png" alt="" width="50" height="46">
                    <h3>Are you sure want to delete this ?</h3>
                    <div class="m-t-20"> <a href="#" class="btn btn-white" data-bs-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Delete  Modal -->
<script>

$(document).on('click','.view_appmodes',function(){
    var id = $(this).data('id');
    var url = "{{ route('appoinment_mode.view', ':id') }}";
    url = url.replace(':id', id);
    $.get(url, function (data) {
        var status = 'Active'
            if(data.status!=0){
                status = 'In Active'
            }
            $('#v_name').text(data.name);
            $('#v_desc').text(data.desc);
            $('#v_status').text(status);
            $('#v_created').text(dateFormate(data.created_at));
            $('#v_updated').text(dateFormate(data.updated_at));
    })
});
$(document).ready(function($) {
setTimeout(() => {
    $('.alert').addClass('hide')
}, 2500)
    var loginType = "{{ Auth::user()->type}}";
    var listUrl="{{ route('appoinment_mode.list') }}";
    $(document).on('click','.delete_appmodes',function(){
        var id = $(this).data('id');
        $('#e_id').val(id);
    });

    var table = $('#appoinment_mode_list').DataTable({
        processing: true,
        responsive: true,
        pageLength: 10,
        lengthMenu: [[10, 20, 25, 50, -1], [10, 20, 25, 50, 'All']],
        serverSide: true,
        ajax: listUrl,
        columns: [
            {data: 'idRows', name: 'idRows'},
            {data: 'name', name: 'name'},
            {data: 'desc', name: 'desc'},
            {data: 'status', name: 'status'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });
});
</script>
@endsection
