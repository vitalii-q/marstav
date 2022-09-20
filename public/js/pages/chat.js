let sidebar = document.getElementById('sidebar');
let chat = document.getElementById('chat');
let stub = document.getElementById('chat_stub');
chat.style.height = sidebar.getBoundingClientRect().height -110 + 'px';

let chat_dialogs = document.getElementById('chat_dialogs');
chat_dialogs.style.height = sidebar.getBoundingClientRect().height -110 -45 -39 -53 + 'px';

let chat_right = document.getElementById('chat_right');
chat_right.style.height = sidebar.getBoundingClientRect().height -134 + 'px';
stub.style.height = sidebar.getBoundingClientRect().height -134 + 'px!important';
chat_right.scrollTop = chat_right.scrollHeight;

let dialog_wrapper = document.getElementById('dialog_wrapper');
let dialog = document.getElementById('dialog');
let files = document.getElementById('files');
let notification = document.getElementById('files_info');
let error = document.getElementById('files_error');
let chat_name = document.getElementById('chat_name');
let dialog_avatar = document.getElementById('dialog_avatar');
let dialog_avatar_link = document.getElementById('dialog_avatar_link');
let text = document.getElementById('text');
let send_button = document.getElementById('send_button');

let messages_shown = 10;

function getFilesTemplate(files) {
    if(files) {
        let template_files = '<div class="files d-flex flex-wrap">';

        for (let i = 0; i < files.length; i++) {
            template_files = template_files.concat('<a href="'+files[i].src+'" download="">\n' +
                '<div class="file">\n' +
                '<i class="si si-doc file_icon"></i>'+files[i].name+'</div>\n' +
                '</a>');
        }
        template_files = template_files.concat("</div>");
        return template_files;
    } else {
        return '';
    }
}

function getMessageSeriesTemplate(photo, message, time, files, self = false) {
    let classes = ''; let reverse = '';
    if (self) {
        classes = 'bg-body-dark text-dark rounded px-15 py-10 mb-5 ml-auto';
        reverse = 'flex-row-reverse';
    } else {
        classes = 'bg-primary-lighter text-primary-darker rounded px-15 py-10 mb-5'; // d-inline-block
    }

    let template_files = getFilesTemplate(files);
    message = message ? message : '';

    return '<div class="d-flex messages_series '+reverse+' mb-20">\n' +
        '<div>\n' +
        '<a class="img-link img-status" href="javascript:void(0)">\n' +
        '<div class="img-avatar avatar32" style="background-image: url('+photo+')"></div>\n' +
        '</a>\n' +
        '</div>\n' +
        '<div class="mx-10 text-right messages_group">\n' +
        '<div class="messages_item '+classes+'">\n' +
        '<p class="mb-5">'+message+'</p>' + template_files +
        '</div>\n' +
        '<div class="text-right text-muted font-size-xs font-italic time">'+time+'</div>\n' +
        '</div>\n' +
        '</div>';
}

function getMessageTemplate(message, time, files, self = false) {
    let classes = '';
    if (self) {
        classes = 'bg-body-dark text-dark rounded px-15 py-10 mb-5 ml-auto';
    } else {
        classes = 'bg-primary-lighter text-primary-darker rounded px-15 py-10 mb-5'; // d-inline-block
    }

    let template_files = getFilesTemplate(files);
    message = message ? message : '';

    return '<div class="messages_item '+classes+'">\n' +
        '<p class="mb-5">'+message+'</p>\n' + template_files +
        '</div>';
}

let serial_time = '';
function showMessage(photo, text, time, files = [], self = false, continuing = false) {
    let selected_dialog = $('#dialog');

    if (!continuing) {
        let show_time = showTime(serial_time, time);
        let last_time_elem = selected_dialog.children().last().find('.time')[0];

        let have_reverse = selected_dialog.children().last().hasClass('flex-row-reverse');

        if((!have_reverse && !self && !show_time && last_time_elem) || (have_reverse && self && !show_time)) {
            $(last_time_elem).before(getMessageTemplate(text, time, files, self));
        } else {
            serial_time = time;
            $(selected_dialog).append(getMessageSeriesTemplate(photo, text, time, files, self));
        }
    } else {
        let last_series = dialog.querySelector('.messages_series');
        let have_reverse = selected_dialog.children().first().hasClass('flex-row-reverse');

        let continuing_last_time = last_series.querySelector('.time')
        let show_time = showTime(continuing_last_time.innerHTML, time, true);

        if((!show_time && !self && !have_reverse) || (have_reverse && self && !show_time)) {
            let last_item = selected_dialog.children().first().find('.messages_item')[0];
            $(last_item).before(getMessageTemplate(text, time, files, self));
        } else {
            $(last_series).before(getMessageSeriesTemplate(photo, text, time, files, self));
        }
    }
}

function checkDateTime(previous_full_time, full_time) {
    if(previous_full_time[0] == full_time[0] && previous_full_time[1] == full_time[1]) {
        let l_time = previous_full_time[2].split(':');
        let n_time = full_time[2].split(':');

        if (Number((l_time[0]+''+l_time[1]))+2 > (Number(n_time[0]+''+n_time[1]))) {
            return false;
        }
    }

    return true;
}

function showTime(serial_time, time, continuing = false) {
    if(!continuing) {
        if(serial_time.length == 5) {
            let l_time = serial_time.split(':');
            let n_time = time.split(':');

            if(Number((l_time[0]+''+l_time[1]))+2 > Number((n_time[0]+''+n_time[1]))) {
                return false;
            }
        }

        if(!checkDateTime(serial_time.split(' '), time.split(' '))) { return false; }
    } else if (continuing) {
        if(serial_time.length == 5) {
            let l_time = serial_time.split(':');
            let n_time = time.split(':');

            if (Number((l_time[0]+''+l_time[1])) < Number((n_time[0]+''+n_time[1]))+2) {
                return false;
            }
        }

        if(!checkDateTime(serial_time.split(' '), time.split(' '))) { return false; }
    }

    return true;
}

function proxyShowMessage(data, continuing) {
    if (!continuing) {
        data.message.reverse();
    }

    for (let i = 0; i < data.message.length; i++) {
        let time = getTimeValue(data.server_time, data.message[i].time);
        if (data.user.id == data.message[i].from_id) {
            showMessage(data.user.photo, data.message[i].text, time, data.message[i].files,true, continuing);
        } else {
            showMessage(data.employee.photo, data.message[i].text, time, data.message[i].files, false, continuing);
        }
    }
}

function getTimeValue(server_time, message_time) {
    // server time
    let serv = server_time.split(' ');
    let serv_date = serv[0].split('-');
    let serv_time = serv[1].split(':');
    let s_m = serv_date[0];
    let s_d = serv_date[1];
    let s_h = serv_time[0];
    let s_mi = serv_time[1];

    // message time
    let mess = message_time.split(' ');
    let mess_date = mess[0].split('-');
    let mess_time = mess[1].split(':');
    let m_m = mess_date[0];
    let m_d = mess_date[1];
    let m_h = mess_time[0];
    let m_mi = mess_time[1];

    //let month = ['', 'Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря'];
    let month = ['', 'Янв', 'Фев', 'Мар', 'Апр', 'Мая', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'];

    let time = m_d+' '+month[m_m]+' '+m_h+':'+m_mi;

    if (s_d+' '+month[s_m] == m_d+' '+month[m_m]) {
        time = m_h+':'+m_mi;
    }

    return time;
}

function firstOpenDialog() {
    if (dialog_wrapper.classList.contains('d-none')) {
        let dialog_top = document.getElementById('dialog_top');
        let dialog_bottom = document.getElementById('dialog_bottom');

        stub.classList.add('d-none');
        dialog_wrapper.classList.remove('d-none');
        dialog_top.classList.remove('d-none');
        dialog_top.classList.add('d-flex');
        dialog_bottom.classList.remove('d-none');
    }
}

function openDialog(code) {
    firstOpenDialog();
    dialog.setAttribute('data-code', code);
    let new_mess_count = document.getElementById('new_mess_count_'+code);

    send_button.setAttribute('onclick', 'sendMessage("'+code+'")');

    $.ajax({
        url: '/chat/' + code + '/dialog',
        type: "post",
        async: false,
        cache: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: (data) => {
            //console.log();

            dialog.innerHTML = '';
            new_mess_count.classList.add('d-none');

            let name = data.employee.name?data.employee.name:'';
            let surname = data.employee.surname?data.employee.surname:'';
            chat_name.innerText = surname+' '+name;
            chat_name.setAttribute('href', '/profile/'+code);
            dialog_avatar.setAttribute('style', data.employee.photo?'background-image: url('+data.employee.photo+')':'');
            dialog_avatar_link.setAttribute('href', '/profile/'+code);

            proxyShowMessage(data)

            dialog_wrapper.scrollTop = dialog_wrapper.scrollHeight; // скролл вниз
            text.value = '';
            messages_shown = 10;
        }
    })
}

function inputFilesCountNotification() {
    let text;
    if (files.files.length == 0 || files.files.length == 5 || files.files.length == 6 || files.files.length == 7 || files.files.length == 8
        || files.files.length == 9 || files.files.length == 10) {
        text = 'Вы прикрепили '+files.files.length+' файлов';

        filesNotificationInfoShow(notification, error, text)
    } else if (files.files.length == 1) {
        text = 'Вы прикрепили 1 файл';

        filesNotificationInfoShow(notification, error, text)
    } else if (files.files.length == 2 || files.files.length == 3 || files.files.length == 4) {
        text = 'Вы прикрепили '+files.files.length+' файла';

        filesNotificationInfoShow(notification, error, text)
    } else if (files.files.length > 10) {
        text = 'Вы можете прикрепить не более 10 файлов';

        error.innerText = text;
        notification.classList.add('d-none');
        error.classList.remove('d-none');
    }
}
function filesNotificationInfoShow(notification, error, text) {
    notification.innerText = text;
    error.classList.add('d-none');
    notification.classList.remove('d-none');
}

function sendMessage(code) {
    let text = document.getElementById('text');

    if(files.files.length > 10) {
        error.innerHTML = 'Вы можете прикрепить не более 10 файлов';
        error.classList.remove('d-none');
    } else if (text.value.length > 4000) {
        error.innerHTML = 'Слишком длинное сообщение';
        error.classList.remove('d-none');
    } else {
        error.innerHTML = '';
        error.classList.add('d-none');

        let formData = new FormData(document.getElementById('message_form')); // передача файлов через ajax
        $.ajax({
            url: '/chat/'+code+'/message',
            type: "post",
            async: false,
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (data) => {
                //console.log(data);

                error.classList.add('d-none');
                notification.classList.add('d-none');
                files.value = '';

                let time = getTimeValue(data.server_time, data.message.time);
                showMessage(data.photo, data.message.text, time, data.files, true);

                dialog_wrapper.scrollTop = dialog_wrapper.scrollHeight;
                text.value = '';
            }
        })
    }
}

dialog_wrapper.addEventListener('scroll', function () {
    if (dialog_wrapper.scrollTop === 0) {
        let code = dialog.getAttribute('data-code');

        $.ajax({
            url: '/chat/' + code + '/more_messages',
            type: "post",
            async: false,
            cache: false,
            data: {
                messages_shown: messages_shown
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (data) => {
                //console.log(data);

                let previous_dialog_height = dialog_wrapper.scrollHeight;
                proxyShowMessage(data, true);
                dialog_wrapper.scrollTop = dialog_wrapper.scrollHeight - previous_dialog_height;
                messages_shown = messages_shown + 10;
            }
        });
    }
});
