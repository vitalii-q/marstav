function addEmployee() {
    let employee_id = document.getElementById('modal_add_employee_id').value;
    let company_id = document.getElementById('modal_add_company_id').value;

    $.ajax({
        url: '/company',
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

            //window.reload;
        }
    })
}



