<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('js/jquery.js') }}"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

<!-- jquery ScrollUp JS -->
<script src="{{ asset('js/scrollup/jquery.scrollUp.js') }}"></script>

@if(\Request::route()->getName() == 'admin.dashboard')
<!-- Sparkline Graphs -->
<!-- <script src="js/sparkline/sparkline.js"></script> -->
<script src="{{ asset('js/sparkline/retina.js') }}"></script>
<script src="{{ asset('js/sparkline/custom-sparkline.js') }}"></script>

<!-- D3 JS -->
<script src="{{ asset('js/d3/d3.v3.min.js') }}"></script>

<!-- D3 Power Gauge -->
<script src="{{ asset('js/d3/d3.powergauge.js') }}"></script>

<!-- D3 Meter Gauge Chart -->
<script src="{{ asset('js/d3/gauge.js') }}"></script>
<script src="{{ asset('js/d3/gauge-custom.js') }}"></script>

<!-- C3 Graphs -->
<script src="{{ asset('js/c3/c3.min.js') }}"></script>
<script src="{{ asset('js/c3/c3.custom.js') }}"></script>

<!-- NVD3 JS -->
<script src="{{ asset('js/nvd3/nv.d3.js') }}"></script>
<script src="{{ asset('js/nvd3/nv.d3.custom.boxPlotChart.js') }}"></script>
{{--<script src="{{ asset('js/nvd3/nv.d3.custom.stackedAreaChart.js') }}"></script>--}}

<!-- Horizontal Bar JS -->
<script src="{{ asset('js/horizontal-bar/horizBarChart.min.js') }}"></script>
<script src="{{ asset('js/horizontal-bar/horizBarCustom.js') }}"></script>

<!-- Gauge Meter JS -->
<script src="{{ asset('js/gaugemeter/gaugeMeter-2.0.0.min.js') }}"></script>
<script src="{{ asset('js/gaugemeter/gaugemeter.custom.js') }}"></script>


<!-- Calendar Heatmap JS -->
<script src="{{ asset('js/heatmap/cal-heatmap.min.js') }}"></script>
<script src="{{ asset('js/heatmap/cal-heatmap.custom.js') }}"></script>

<!-- Odometer JS -->
<script src="{{ asset('js/odometer/odometer.min.js') }}"></script>
<script src="{{ asset('js/odometer/custom-odometer.js') }}"></script>
@endif

<!-- Peity JS -->
<script src="{{ asset('js/peity/peity.min.js') }}"></script>
<script src="{{ asset('js/peity/custom-peity.js') }}"></script>

<!-- Circliful js -->
<script src="{{ asset('js/circliful/circliful.min.js') }}"></script>
<script src="{{ asset('js/circliful/circliful.custom.js') }}"></script>

<!-- jQuery Toaster js -->
<script src="{{ asset('js/alertify.min.js') }}"></script>

<!-- jQuery Datatable js -->
<script src="{{ asset('js/datatables/dataTables.min.js') }}"></script>

<!-- select 2 -->
<script src="{{ asset('js/select2.min.js') }}"></script>

<!-- jQuery UI js -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js"></script>

<!-- iCheck -->
<script src="{{ asset('js/icheck/icheck.min.js') }}"></script>

<!-- MulitSelect js -->
<script src="{{ asset('vendor/multiselect/js/jquery.multi-select.js') }}"></script>
<script>

    $(function () {
        alertify.set('notifier','position', 'top-right');

        @if(Session::has('flash_success'))
        alertify.success('{{ Session::get( 'flash_success' ) }}');
        @endif

        @if(Session::has('flash_error'))
        alertify.error('{{ Session::get( 'flash_error' ) }}');
        @endif

        $('input[data-phone]').on('input', function (e) {
            var x = $(this).val().replace(/\D/g, '').match(/(\d{0,4})(\d{0,7})/);
            $(this).val(!x[2] ? x[1] : x[1] + '-' + x[2]);
        });

        $('input[data-cnic]').on('input', function (e) {
            var x = $(this).val().replace(/\D/g, '').match(/(\d{0,5})(\d{0,7})(\d{0,1})/);
            $(this).val(!x[2] ? x[1] : x[1] + '-' + x[2] + (x[3] ? '-' + x[3] : ''));
        });


    });

</script>


<!-- Custom JS -->
<script src="{{ asset('js/custom.js') }}"></script>





