const maxfilesize = 10000000; // b

/* Notifications */
function companyInvitationSuccess(e) {
    code = e.getAttribute('data-code');

    $.ajax({
        url: '/notification/company_invitation_success',
        type: "post",
        async: true,
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
    //location.reload();
}

function companyInvitationCancel(e) {
    code = e.getAttribute('data-code');

    $.ajax({
        url: '/notification/company_invitation_cancel',
        type: "post",
        async: true,
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
                    text: 'Аккаунт утратит доступ к чату, задачам компании и загруженным файлам.',
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
                            async: true,
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
function storageIsFull(files) {
    let response = false;
    let download_size = 0;

    for (let i = 0; i < files.length; i++) {
        download_size = download_size + files[i].size;
    }

    $.ajax({
        url: '/storage/check',
        type: 'post',
        async: false,
        data: {
            download_size: download_size
        },
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
function showStorageModal(storage_info) {
    let modal_storage_percents = document.getElementById('modal_storage_percents');
    let modal_storage_involved = document.getElementById('modal_storage_involved');
    let modal_storage_total = document.getElementById('modal_storage_total');

    modal_storage_percents.classList.remove('bg-danger');
    modal_storage_percents.classList.remove('bg-warning');
    modal_storage_percents.classList.remove('bg-success');

    modal_storage_percents.classList.add('bg-'+storage_info.style);

    modal_storage_percents.style.width = storage_info.space_parcents + '%';
    modal_storage_involved.innerText = storage_info.space_involved + 'GB';
    modal_storage_total.innerText = storage_info.space_total + 'GB';

    document.getElementById('modal_storage_btn').click();
}

function inputFilesNotifications() {
    let text;

    if(!checkFilesSize(files.files)) {
        text = 'Максимальный размер загружаемых файлов 10mb';
        filesNotificationErrorShow(notification, error, text)
    } else if (files.files.length > 10) {
        text = 'Вы можете прикрепить не более 10 файлов';
        filesNotificationErrorShow(notification, error, text);
    } else if (files.files.length == 0 || files.files.length == 5 || files.files.length == 6 || files.files.length == 7 || files.files.length == 8
        || files.files.length == 9 || files.files.length == 10) {
        text = 'Вы прикрепили '+files.files.length+' файлов';
        filesNotificationInfoShow(notification, error, text)
    } else if (files.files.length == 1) {
        text = 'Вы прикрепили 1 файл';
        filesNotificationInfoShow(notification, error, text)
    } else if (files.files.length == 2 || files.files.length == 3 || files.files.length == 4) {
        text = 'Вы прикрепили '+files.files.length+' файла';
        filesNotificationInfoShow(notification, error, text)
    }
}

function filesNotificationInfoShow(notification, error, text) {
    notification.innerText = text;
    error.classList.add('d-none');
    notification.classList.remove('d-none');
}
function filesNotificationErrorShow(notification, error, text) {
    error.innerText = text;
    notification.classList.add('d-none');
    error.classList.remove('d-none');
}

function checkFilesSize(files) {
    for (let i = 0; i < files.length; i++) {
        if(files[i].size > maxfilesize) {
            return false;
        }
    }

    return true;
}
