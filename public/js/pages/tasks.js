function inputFilesCountNotification() {
    let files = document.getElementById('files');
    let notification = document.getElementById('files_info');
    let error = document.getElementById('files_error');

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

let stub = document.getElementById('tasks_stub');
let add_task_btn = document.getElementById('add_task_btn');
if(stub && add_task_btn) {
    stub.addEventListener(("click"), function (e) {
        add_task_btn.click();
    });
}

let modal_task_transmit_close = document.getElementById('modal_task_transmit_close');
function taskTransmit() {
    let employee_input = document.getElementById('task_employee');
    let modal_task_transmit = document.getElementById('modal_task_transmit');
    let code = modal_task_transmit.getAttribute('data-task');

    let error = document.getElementById('task_transmit_error');
    if(employee_input.value.length < 1) {
        error.innerHTML = 'Выберите исполнителя.';
        error.classList.remove('d-none');
    } else if (employee_input.value.length > 255) {
        error.innerHTML = 'Проверьте верность ввода.';
        error.classList.remove('d-none');
    } else {
        error.innerHTML = '';
        error.classList.add('d-none');

        $.ajax({
            url: '/tasks/'+code+'/transmit',
            type: "post",
            async: false,
            data: {
                employee: employee_input.value
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (data) => {
                //console.log(data);
                modal_task_transmit_close.click();
                location.reload();
            }
        })
    }
}

let modal_task_members_close = document.getElementById('modal_task_members_close');
function taskAddMembers() {
    let employee_input = document.getElementById('task_add_member');
    let modal_task_transmit = document.getElementById('modal_task_members');
    let code = modal_task_transmit.getAttribute('data-task');

    let error = document.getElementById('task_add_member_error');
    if(employee_input.options.length < 1) {
        error.innerHTML = 'Выберите сотрудника.';
        error.classList.remove('d-none');
    } else if (employee_input.options.length > 10) {
        error.innerHTML = 'Выберите не более 10 сотрудников.';
        error.classList.remove('d-none');
    } else {
        error.innerHTML = '';
        error.classList.add('d-none');

        let options = [];
        for(let i=0; i < employee_input.options.length; i++) {
            if (employee_input.options[i].selected) {
                options.push(employee_input.options[i].value);
            }
        }

        $.ajax({
            url: '/tasks/'+code+'/add_member',
            type: "post",
            async: false,
            data: {
                employees: options
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (data) => {
                //console.log(data);
                modal_task_members_close.click();
                location.reload();
            }
        })
    }
}

