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
    location.reload();
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

/* expel an employee from the company */
let expel_an_employee = document.getElementById('expel_an_employee');
if (expel_an_employee) {
    class BeUIActivity {
        static barsRandomize() {
            jQuery('.js-bar-randomize').on('click', e => {
                jQuery(e.currentTarget)
                    .parents('.block')
                    .find('.progress-bar')
                    .each((index, element) => {
                        let el      = jQuery(element);
                        let random  = Math.floor((Math.random() * 91) + 10);

                        // Update progress width
                        el.css('width', random  + '%');

                        // Update progress label
                        jQuery('.progress-bar-label', el).html(random  + '%');
                    });
            });
        }

        static sweetAlert2() {
            let toast = Swal.mixin({
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-alt-success m-5',
                    cancelButton: 'btn btn-alt-danger m-5',
                    input: 'form-control'
                }
            });
            jQuery('.js-swal-confirm').on('click', e => {
                toast.fire({
                    title: 'Вы уверены?',
                    text: 'Действие не обратимо!',
                    icon: 'warning',
                    showCancelButton: true,
                    customClass: {
                        confirmButton: 'btn btn-alt-danger m-1',
                        cancelButton: 'btn btn-alt-secondary m-1'
                    },
                    confirmButtonText: 'Да, подтверждаю!',
                    html: false,
                    preConfirm: e => {
                        return new Promise(resolve => {
                            setTimeout(() => {
                                resolve();
                            }, 50);
                        });
                    }
                }).then(result => {
                    if (result.value) {
                        let code = expel_an_employee.getAttribute('data-code');

                        $.ajax({
                            url: '/profile/leave_сompany',
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

                                location.reload();
                            }
                        })
                    }
                });
            });
        }

        static init() {
            this.barsRandomize();
            this.sweetAlert2();
        }
    }
    jQuery(() => { BeUIActivity.init(); });
}

/* check storage */
function storageCheck() {
    let response = false;

    $.ajax({
       url: '/storage/check',
       type: 'post',
       async: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: (data) => {
           //console.log(data);

            response = data;
        }
    });

    return response;
}
