let contacts = document.getElementById('contacts');
if(contacts) {
    let sidebar = document.getElementById('sidebar');
    //let stub = document.getElementById('contacts_stub');
    contacts.style.height = sidebar.getBoundingClientRect().height -110 + 'px';

    let contacts_list = document.getElementById('contacts_list');
    contacts_list.style.height = sidebar.getBoundingClientRect().height -110 -45 -39 -90 + 'px';

    let contacts_right = document.getElementById('contacts_right');
    contacts_right.style.height = sidebar.getBoundingClientRect().height -134 + 'px';
    //stub.style.height = sidebar.getBoundingClientRect().height -134 + 'px!important';
    contacts_right.scrollTop = contacts_right.scrollHeight;
}

function contactTemplate(data) {
    let template = '';

    let group_start = '<div class="form-group row">';
    let col_6 = '<div class="col-12 col-lg-6 mb-10">';
    let col_12 = '<div class="col-12 mb-10">';
    let end = '</div>';

    let full_name = '<h3 class="mb-10">';
    if (data.surname) {full_name = full_name+data.surname+' ';}
    if (data.name) {full_name = full_name+data.name+' ';}
    if (data.patronymic) {full_name = full_name+data.patronymic+' ';}
    full_name = full_name+'</h3>';

    template = template+full_name;
    if (data.born) {
        template = template+'<small class="fs-14">'+data.born+'</small>';
    }

    if (data.phone != null || data.private_phone != null || data.email != null || data.private_email != null) {
        template = template+'<hr>'+group_start;

        if (data.phone != null) {
            template = template+col_6+'<label>Номер телефона</label><div class="">'+data.phone+'</div>'+end;
        }

        if (data.private_phone != null) {
            template = template+col_6+'<label>Номер телефона (личный)</label><div class="">'+data.private_phone+'</div>'+end;
        }

        if (data.email != null) {
            template = template+col_6+'<label>Электронная почта</label><div class="">'+data.email+'</div>'+end;
        }

        if (data.private_email != null) {
            template = template+col_6+'<label>Электронная почта (личная)</label><div class="">'+data.private_email+'</div>'+end;
        }

        template = template+end;
    }

    if (data.position != null || data.company != null || data.address != null) {
        template = template+'<hr>'+group_start;

        if (data.position != null) {
            template = template+col_6+'<label>Должность</label><div class="">'+data.position+'</div>'+end;
        }

        if (data.company != null) {
            template = template+col_6+'<label>Компания</label><div class="">'+data.company+'</div>'+end;
        }

        if (data.address != null) {
            template = template+col_6+'<label>Адрес</label><div class="">'+data.address+'</div>'+end;
        }

        template = template+end;
    }

    if (data.note) {
        template = template+'<hr>'+'<div class="form-group row mb-20">'+col_12+data.note+end+end;
    }

    template = template+'<a href="contacts/'+data.code+'/edit" type="button" class="btn btn-primary w-100 mb-20">Редактировать</a>';

    return template;
}

function showContact(code) {
    let contacts_stub = document.getElementById('contacts_stub');
    let contact_info = document.getElementById('contact_info');

    if (!contacts_stub.classList.contains('d-none')) {
        contacts_stub.classList.add('d-none');
    }

    $.ajax({
        url: '/contacts/'+code,
        type: "get",
        async: false,
        cache: false,
        data: {
            code: code
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: (data) => {
            //console.log(data);

            if (contact_info.classList.contains('d-none')) {
                contact_info.classList.remove('d-none');
            }

            let template = contactTemplate(data);
            contact_info.innerHTML = template;
        }
    });
}

function contactsSearch(e) {
    let contacts_list = document.getElementsByClassName('chat-list-item');
    for (let i=0; i < contacts_list.length; i++) {
        let name = contacts_list[i].querySelector('.contact_name').innerHTML;

        if(name.toUpperCase().includes(e.value.toUpperCase())) {
            contacts_list[i].classList.remove('d-none');
        } else {
            contacts_list[i].classList.add('d-none');
        }
    }
}


