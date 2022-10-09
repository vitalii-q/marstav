let company_add_employee_error = document.getElementById('company_add_employee_error');

function addEmployee() {
    if(employeesCountCheck()) {
        let employee_id = document.getElementById('modal_add_employee_id').value;
        let company_id = document.getElementById('modal_add_company_id').value;

        $.ajax({
            url: '/company/add_employee',
            type: "post",
            async: false,
            data: {
                employee_id: employee_id,
                company_id: company_id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (data) => {
                //console.log(data);

                location.reload();
            }
        })
    } else {
        company_add_employee_error.innerHTML = 'Вы достигли лимита пользователей. Вы можете <a href="/settings/rates"><strong>выбрать тариф</strong></a> с большим количеством пользователей.';
        company_add_employee_error.classList.remove('d-none');
    }
}

function employeesCountCheck() {
    let response = false;
    $.ajax({
        url: '/company/employees_check',
        type: "post",
        async: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: (data) => {
            //console.log(data);

            if (data) {
                response = true;
            }
        }
    })

    return response;
}


