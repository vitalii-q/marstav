function addEmployee() {
    let employee_id = document.getElementById('modal_add_employee_id');

    $.ajax({
        url: '/company',
        type: "post",
        async: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: (data) => {
            console.log(data);
        }
    })
}
