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
                                        <h3>Doctors List</h3>
                                        <div class="doctor-search-blk">
                                            {{-- <div class="top-nav-search table-search-blk">
                                                <form>
                                                    <input type="text" class="form-control" placeholder="Search here">
                                                    <a class="btn"><img src="../assets/img/icons/search-normal.svg" alt=""></a>
                                                </form>
                                            </div> --}}
                                            <div class="add-group">
                                                <a href="{{url('doctor/add')}}" class="btn btn-primary add-pluss ms-2" title="Add"><img src="{{URL::to('public/assets/img/icons/plus.svg')}}" alt=""></a>
                                                {{-- <a href="javascript:;" class="btn btn-primary doctor-refresh ms-2" title="Refresh"><img src="{{URL::to('public/assets/img/icons/re-fresh.svg')}}" alt=""></a> --}}
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
                            <table class="table border-0 custom-table comman-table datatable mb-0" id="doctor_list">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Specialization</th>
                                        <th>Degree</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
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
<div id="delete_doctor" class="modal fade delete-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <form action="{{route('doctor.delete')}}" method="POST">
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
<script>
$(document).ready(function($) {
    var loginType = "{{ Auth::user()->type}}";
    var listUrl="{{ route('doctor.lists') }}";
    $(document).on('click','.delete_doctor',function(){
        var id = $(this).data('id');
        $('#e_id').val(id);
    });

    var doctorTable = $('#doctor_list').DataTable({
        processing: true,
        responsive: true,
        pageLength: 10,
        lengthMenu: [[10, 20, 25, 50, -1], [10, 20, 25, 50, 'All']],
        serverSide: true,
        ajax: listUrl,
        columns: [
            {data: 'idRows', name: 'idRows'},
            {data: 'name', name: 'name'},
            {data: 'department', name: 'department'},
            {data: 'specialization', name: 'specialization'},
            {data: 'degree', name: 'degree'},
            {data: 'mobile', name: 'mobile'},
            {data: 'email', name: 'email'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action'},
        ]
    });
});
</script>
@endsection
