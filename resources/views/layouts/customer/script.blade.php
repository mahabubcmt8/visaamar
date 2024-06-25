<!-- Required Jquery -->
<script type="text/javascript" src="{{ asset('user/assets/js/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('user/assets/js/jquery-ui/jquery-ui.min.js ') }}"></script>
<script type="text/javascript" src="{{ asset('user/assets/js/popper.js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('user/assets/js/bootstrap/js/bootstrap.min.js ') }}"></script>
<script type="text/javascript" src="{{ asset('user/assets/pages/widget/excanvas.js ') }}"></script>
<!-- waves js -->
<script src="{{ asset('user/assets/pages/waves/js/waves.min.js') }}"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="{{ asset('user/assets/js/jquery-slimscroll/jquery.slimscroll.js ') }}"></script>
<!-- modernizr js -->
<script type="text/javascript" src="{{ asset('user/assets/js/modernizr/modernizr.js ') }}"></script>
<!-- slimscroll js -->
<script type="text/javascript" src="{{ asset('user/assets/js/SmoothScroll.js') }}"></script>
<script src="{{ asset('user/assets/js/jquery.mCustomScrollbar.concat.min.js ') }}"></script>
<!-- Chart js -->
<script type="text/javascript" src="{{ asset('user/assets/js/chart.js/Chart.js') }}"></script>
<!-- amchart js -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="{{ asset('user/assets/pages/widget/amchart/gauge.js') }}"></script>
<script src="{{ asset('user/assets/pages/widget/amchart/serial.js') }}"></script>
<script src="{{ asset('user/assets/pages/widget/amchart/light.js') }}"></script>
<script src="{{ asset('user/assets/pages/widget/amchart/pie.min.js') }}"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<!-- menu js -->
<script src="{{ asset('user/assets/js/pcoded.min.js') }}"></script>
<script src="{{ asset('user/assets/js/vertical-layout.min.js') }}"></script>
<!-- custom js -->
<script type="text/javascript" src="{{ asset('user/assets/pages/dashboard/custom-dashboard.js') }}"></script>
<script type="text/javascript" src="{{ asset('user/assets/js/script.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.2/sweetalert2.min.js" integrity="sha512-k1jHgQwcMNMFymeyYv93tJOsIGpceFgh5VDTq2B5pF0pICXBzRGY97vlMobgYA4azK7936iOWkqm/C1vv/PKMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



<!-- DataTables  & Plugins -->
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
    $( function() {
        $(".datepicker").datepicker({
            dateFormat: "dd M yy"
        });
    } );
</script>


<script defer src="https://cdn.jsdelivr.net/npm/@flasher/flasher@1.2.4/dist/flasher.min.js"></script>
@if (session()->has('success'))
    {{ session()->get('success') }}
@endif
@if (session()->has('error'))
    {{ session()->get('error') }}
@endif


<script>
    function error_msg(mes) {
        flasher.error(mes);
    }
    function warning_msg(mes) {
        flasher.warning(mes);
    }
    function success_msg(mes) {
        flasher.success(mes);
    }
    function info_msg(mes) {
        flasher.info(mes);
    }
</script>

@stack('js')
