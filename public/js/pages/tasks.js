let files = document.getElementById('files');
let notification = document.getElementById('files_info');
let error = document.getElementById('files_error');

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

// проверка хранилища при создании задачи
let task_add_form = document.getElementById('task_add_form');
if (task_add_form) {
    function taskCheckStorage() {
        let files = document.getElementById('files');
        let storage_info = storageIsFull(files.files);

        if (storage_info.free_space) {
            task_add_form.submit();
        } else {
            showStorageModal(storage_info);
        }
    }
}

// проверка хранилища при добавлении комментария к задаче
let task_add_comment_form = document.getElementById('task_add_comment_form');
if (task_add_comment_form) {
    function taskCheckStorage() {
        let files = document.getElementById('files');
        let storage_info = storageIsFull(files.files);

        if (storage_info.free_space) {
            task_add_comment_form.submit();
        } else {
            showStorageModal(storage_info);
        }
    }
}
