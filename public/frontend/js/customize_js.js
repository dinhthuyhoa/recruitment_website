
function change_favotire(post_id, user_id, element) {
    $.ajax({
        type: "POST",
        url: '/change-post-favorite',
        dataType: 'json',
        data: {
            'post_id': post_id,
            'user_id': user_id,
        },
        success: function (data) {
            Swal.fire({
                icon: 'success',
                title: data.title,
                text: data.text,
                showConfirmButton: false,
                timer: 1500
            })

            if (data.status == 'remove') {
                $(element).html('<i class="ti-heart"></i>')
            } else {
                $(element).html('<i class="fa fa-heart"></i>')
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            if (textStatus == 'timeout') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error : Timeout for this call!',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        },
        timeout: 10000
    });

}