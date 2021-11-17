<script src="{{ asset('assets/node_modules/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('assets/dist/js/perfect-scrollbar.jquery.min.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('assets/dist/js/waves.js') }}"></script>
<!--Menu sidebar -->
<script src="{{ asset('assets/dist/js/sidebarmenu.js') }}"></script>
<!--stickey kit -->
<script src="{{ asset('assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/sparkline/jquery.sparkline.min.js') }}"></script>
<!--Sweet alert CDN -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!--Custom JavaScript -->
<script src="{{ asset('assets/dist/js/custom.min.js') }}"></script>
<script src="{{ asset('assets/helper/helper.js') }}"></script>
{{-- @jquery --}}
@toastr_js
@toastr_render
@stack('foot')

 {{-- Ajax Delete code --}}
 <script>
    $('table').on('click', '.delete-btn', function(event) {
        let url = $(this).val();
        if (!url) {
            Swal.fire(
                'Wrong!',
                'Empty URL',
                'warning'
            )
        } else {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method: 'DELETE',
                        url: url,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            if (data.type == 'success') {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted. ' + data.message,
                                    'success'
                                )
                                if (data.url) {
                                    setTimeout(function() {
                                        location.replace(data.url);
                                    }, 800); //
                                } else {
                                    setTimeout(function() {
                                        location.reload();
                                    }, 800); //
                                }
                            } else {
                                if (data.message) {
                                    Swal.fire(
                                        'Wrong!',
                                        data.message,
                                        'warning'
                                    )
                                } else {
                                    Swal.fire(
                                        'Wrong!',
                                        'Something going wrong.',
                                        'warning'
                                    )
                                }
                            }
                        },
                    })
                }
            })
        }
    });
</script>
