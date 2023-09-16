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
                                        <h3>Department List</h3>
                                        <div class="doctor-search-blk">
                                            {{-- <div class="top-nav-search table-search-blk">
                                                <form>
                                                    <input type="text" class="form-control" placeholder="Search here">
                                                    <a class="btn"><img src="../assets/img/icons/search-normal.svg" alt=""></a>
                                                </form>
                                            </div> --}}
                                            <div class="add-group">
                                                <a href="{{(Auth::user()->type==2)?url('department/add'):url('admin/department/add')}}" class="btn btn-primary add-pluss ms-2" title="Add"><img src="{{URL::asset('/assets/img/icons/plus.svg')}}" alt=""></a>
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
                            <table class="table border-0 custom-table comman-table datatable mb-0" id="department_list">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </th>
                                        <th>Department</th>
                                        <th>Department Head</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th></th>
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
<!-- View Department Modal -->
<div class="modal fade" id="view_department" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">View</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Name</label>
                        <div class="col-md-9">
                            <p id=""></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Date</label>
                        <div class="col-md-9">
                            <p id=""></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Head</label>
                        <div class="col-md-9">
                            <p id=""></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Status</label>
                        <div class="col-md-9">
                            <p id=""></p>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Description</label>
                    <div class="col-md-9">
                        <p id=""></p>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
<!-- Delete Department Modal -->
<div id="delete_department" class="modal fade delete-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <form action="{{(Auth::user()->type==0)?route('department.delete'):route('admin.department.delete')}}" method="POST">
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
<!-- Delete Department Modal -->
<script>
// $(document).on('click','.view_department',function(){
//     var id = $(this).data('id');
//     var url = "{{ route('department.view', ':id') }}";
//     url = url.replace(':id', id);
//     $.get(url, function (data) {
//         $('#v_name').text(data.name);
//         $('#v_email').text(data.email);
//         $('#v_mobile').text(data.phone_number);
//         $('#v_department').text(data.department.name);
//         $('#v_position').text(data.position.name);
//         $('#v_country').text(data.country.name);
//         $('#v_state').text(data.state.name);
//     })
// });
$(document).ready(function($) {
    var loginType = "{{ Auth::user()->type}}";
    var listUrl="{{ route('department.list') }}";
    if(loginType==3){
        listUrl="{{ route('admin.department.list') }}";
    }
    $(document).on('click','.delete_department',function(){
        var id = $(this).data('id');
        $('#e_id').val(id);
    });

    var table = $('#department_list').DataTable({
        processing: true,
        responsive: true,
        pageLength: 10,
        lengthMenu: [[10, 20, 25, 50, -1], [10, 20, 25, 50, 'All']],
        serverSide: true,
        ajax: listUrl,
        columns: [
            // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'idRows', name: 'idRows'},
            {data: 'department_name', name: 'department_name'},
            {data: 'department_head', name: 'department_head'},
            {data: 'department_desc', name: 'department_desc'},
            {data: 'department_date', name: 'department_date'},
            {data: 'department_status', name: 'department_status'},
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
