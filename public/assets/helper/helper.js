$(document).ready(function () {
    $(".logout-btn").click(function () {
        Swal.fire({
            title: 'Logout ?',
            text: "Please remember your credentials",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#061a6c',
            cancelButtonColor: '#b8c7c1',
            confirmButtonText: 'Confirm!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: 'POST',
                    url: "/logout",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function (response) {
                        if (response.type == 'success') {
                            Swal.fire(
                                'Complete !',
                                response.message,
                                response.type
                            )
                            location.replace(response.url);
                        } else {
                            Swal.fire(
                                'Sorry !',
                                response.message,
                                response.type
                            )
                        }
                    },
                    error: function (error) {
                        validation_error(error);
                    },
                })
            }
        })
    });

    // select all check box
    $('.select-all').click(function (event) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var checkbox of checkboxes) {
            checkbox.checked = true;
        }
    });

    // un select all check box
    $('.un-select-all').click(function (event) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var checkbox of checkboxes) {
            checkbox.checked = false;
        }
    });

    //Chose image
    $(".image-chose-btn").click(function () {
        $(this).parent().find('.image-importer').click();
    })

    //Display image
    $(".image-importer").change(function (event) {
        if (event.target.files.length > 0) {
            $(this).parent().find('.image-display').attr("src", URL.createObjectURL(event.target.files[0]));
        }
    })

    //Reset image
    $(".image-reset-btn").click(function () {
        $(this).parent().find('.image-display').attr("src", $(this).val());
        $(this).parent().find('.image-importer').val('');
    })
});

//show validation error message
function validation_error(error) {
    var errorMessage = '<div class="card bg-danger">\n' +
        '                        <div class="card-body text-center p-5">\n' +
        '                            <span class="text-white">';
    $.each(error.responseJSON.errors, function (key, value) {
        errorMessage += ('' + value + '<br>');
    });
    errorMessage += '</span>\n' +
        '                        </div>\n' +
        '                    </div>';
    Swal.fire({
        html: errorMessage,
    })
}




