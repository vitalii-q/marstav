/* Notifications */
function companyInvitationSuccess(e) {
    $.ajax({
        url: '/notification/company_invitation_success',
        type: "post",
        async: false,
        data: {
            code: e.getAttribute('data-code')
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: (data) => {
            console.log(data);
        }
    })
}

function companyInvitationCancel(e) {
    $.ajax({
        url: '/notification/company_invitation_cancel',
        type: "post",
        async: false,
        data: {
            code: e.getAttribute('data-code')
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: (data) => {
            console.log(data);
        }
    })
}

function closeNotification()
{

}
