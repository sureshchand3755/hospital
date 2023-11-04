    {{-- <script src="{{ URL::to('public/assets/plugins/jquery/jquery.min.js')}}"></script> --}}
    <script src="{{ URL::to('public/assets/js/jquery-3.6.1.min.js')}}"></script>
    {{-- <script src="{{ URL::to('public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script> --}}
    <script src="{{ URL::to('public/assets/js/bootstrap.bundle.min.js')}}"></script>
    {{-- <script src="{{ URL::to('public//assets/plugins/theia-sticky-sidebar/ResizeSensor.js')}}"></script> --}}
    {{-- <script src="{{ URL::to('public//assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js')}}"></script> --}}
    {{-- <script src="{{ URL::to('public/assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script> --}}
    {{-- <script src="{{ URL::to('public/assets/plugins/select2/js/select2.min.js')}}"></script> --}}
    <!-- Datatables JS -->
    <script src="{{ URL::to('public/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ URL::to('public/assets/plugins/datatables/datatables.min.js')}}"></script>

    <!-- Calendar Js -->
	<script src="{{ URL::to('public/assets/plugins/simple-calendar/jquery.simple-calendar.js')}}"></script>
	<script src="{{ URL::to('public/assets/js/calander.js')}}"></script>

	<!-- Apexchart JS -->
	<script src="{{ URL::to('public/assets/plugins/apexchart/apexcharts.min.js')}}"></script>
	<script src="{{ URL::to('public/assets/plugins/apexchart/chart-data.js')}}"></script>

	<!-- Circle Progress JS -->
	<script src="{{ URL::to('public/assets/js/circle-progress.min.js')}}"></script>

	<!-- Slick JS -->
	<script src="{{ URL::to('public/assets/plugins/slick/slick.js')}}" ></script>


    <script src="{{ URL::to('public/assets/js/moment.min.js')}}"></script>
    <script src="{{ URL::to('public/assets/js/Chart.bundle.js')}}"></script>
    @if(Route::is(['index']))
    <script src="{{ URL::to('public//assets/js/chart.js')}}"></script>
    @endif
    <script src="{{ URL::to('public/assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{ URL::to('public/assets/js/fullcalendar.min.js')}}"></script>
    <script src="{{ URL::to('public/assets/js/jquery.fullcalendar.js')}}"></script>
    {{-- <script src="{{ URL::to('public/assets/plugins/lightgallery/js/lightgallery-all.min.js')}}"></script> --}}
    <script src="{{ URL::to('public/assets/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ URL::to('public/assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js')}}"></script>

    <script src="{{ URL::to('public/assets/plugins/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <script src="{{ URL::to('public/assets/plugins/jquery-validation/dist/additional-methods.min.js')}}"></script>

    <!-- Slimscroll -->
    <script src="{{ URL::to('public/assets/js/jquery.slimscroll.js')}}"></script>

	<!-- Select2 Js -->
	<script src="{{ URL::to('public/assets/js/select2.min.js')}}"></script>

    <!-- JQuery UI Js -->
	<script src="{{ URL::to('public/assets/js/jquery-ui.js')}}"></script>

   {{-- <script src="{{ URL::to('public/assets/js/ckeditor.js')}}"></script> --}}
    <script src="{{ URL::to('public/assets/js/feather.min.js')}}"></script>
    <script src="{{ URL::to('public/assets/js/app.js')}}"></script>
    <script src="{{ URL::to('public/assets/js/doctor.js')}}"></script>
    <script>
            $(function () {
                $('#datetimepicker3').datetimepicker({
                    format: 'LT'

                });

                $('#country_id').on('change', function () {
                    var idCountry = this.value;
                    $("#state_id").html('');
                    $.ajax({
                        url: "{{url('fetch-states')}}",
                        type: "POST",
                        data: {
                            country_id: idCountry,
                            _token: '{{csrf_token()}}'
                        },
                        dataType: 'json',
                        success: function (result) {
                            $('#state_id').html('<option value="">Select State</option>');
                            $.each(result.states, function (key, value) {
                                $("#state_id").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                            $('#city_id').html('<option value="">Select City</option>');
                        }
                    });
                });

                $('#state_id').on('change', function () {
                    var idState = this.value;
                    $("#city_id").html('');
                    $.ajax({
                        url: "{{url('fetch-cities')}}",
                        type: "POST",
                        data: {
                            state_id: idState,
                            _token: '{{csrf_token()}}'
                        },
                        dataType: 'json',
                        success: function (res) {
                            $('#city_id').html('<option value="">Select City</option>');
                            $.each(res.cities, function (key, value) {
                                $("#city_id").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                        }
                    });
                });
            });
</script>
