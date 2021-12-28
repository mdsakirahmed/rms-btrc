<script src="{{ asset('assets/node_module_files/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('assets/node_module_files/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('assets/dist/js/perfect-scrollbar.jquery.min.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('assets/dist/js/waves.js') }}"></script>
<!--Menu sidebar -->
<script src="{{ asset('assets/dist/js/sidebarmenu.js') }}"></script>
<!--stickey kit -->
<script src="{{ asset('assets/node_module_files/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
<script src="{{ asset('assets/node_module_files/sparkline/jquery.sparkline.min.js') }}"></script>
<!--Sweet alert CDN -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!--Custom JavaScript -->
<script src="{{ asset('assets/dist/js/custom.min.js') }}"></script>
<script src="{{ asset('assets/helper/helper.js') }}"></script>
{{-- @jquery --}}
@toastr_js
@toastr_render
@stack('foot')
