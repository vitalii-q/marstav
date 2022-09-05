/* Notifications */
function companyInvitationSuccess(e) {
    code = e.getAttribute('data-code');

    $.ajax({
        url: '/notification/company_invitation_success',
        type: "post",
        async: false,
        data: {
            code: code
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: (data) => {
            //console.log(data);
        }
    })

    closeNotification(code);
}

function companyInvitationCancel(e) {
    code = e.getAttribute('data-code');

    $.ajax({
        url: '/notification/company_invitation_cancel',
        type: "post",
        async: false,
        data: {
            code: code
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: (data) => {
            //console.log(data);
        }
    })

    closeNotification(code);
}

function closeNotification(code) {
    let notification = document.getElementById('notification_'+code);
    notification.remove();
}
