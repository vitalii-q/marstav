let deals = document.getElementById('deals');
let modal_add_deal = document.getElementById('modal_add_deal');
let modal_change_deal = document.getElementById('modal_change_deal');
let modal_add_deal_close = document.getElementById('modal_add_deal_close');
let modal_change_deal_close = document.getElementById('modal_change_deal_close');
let update_deal_btn = document.getElementById('update_deal_btn');
let next_deal_btn = document.getElementById('next_deal_btn');
let close_deal_btn = document.getElementById('close_deal_btn');

let sidebar = document.getElementById('sidebar');
let deals_list = document.getElementById('deals_list');
deals_list.style.height = sidebar.getBoundingClientRect().height -265 + 'px';

// arrow buttons
let stages_list = document.getElementById('stages_list');
let arrow_wrappers = document.getElementsByClassName('arrow_wrapper');
for (let i = 0; i < arrow_wrappers.length; i++) {
    arrow_wrappers[i].style.height = deals_list.style.height;
    arrow_wrappers[i].style.marginTop = stages_list.getBoundingClientRect().height + 'px';
}

// scroll x
let deals_canvas_width = 0;
let stage_deals = document.getElementsByClassName('stage_deals');
for (let i = 0; i < stage_deals.length; i++) {
    deals_canvas_width = Number(deals_canvas_width) + Number(stage_deals[0].getBoundingClientRect().width);
}

let arrow_left_block = document.getElementById('arrow_left_block');
let arrow_right_block = document.getElementById('arrow_right_block');
if(Number(deals.scrollLeft) === 0) {
    arrow_left_block.classList.add('d-none');
}

let deals_scroll_wrapper = document.getElementById('deals_scroll_wrapper');
if (deals_canvas_width < deals.getBoundingClientRect().width) {
    stages_list.style.width = deals.getBoundingClientRect().width;
    deals_list.style.width = deals.getBoundingClientRect().width;
    deals_scroll_wrapper.classList.add('d-none');
    arrow_right_block.classList.add('d-none');
} else {
    deals_list.style.width = deals_canvas_width + 'px';
    stages_list.style.width = deals_canvas_width + 'px';
}

let arrow_bottom_wrapper = document.getElementById('arrow_bottom_wrapper');
deals_scroll_wrapper.style.height = deals_list.style.height;
deals.addEventListener('scroll', function() {
    arrow_bottom_wrapper.style.marginLeft = Number(deals.scrollLeft) + 'px';

    if(Number(deals.scrollLeft) === 0) {
        arrow_left_block.classList.add('d-none');
    } else {
        arrow_left_block.classList.remove('d-none');
    }

    deals_scroll_wrapper.style.right = '-' + deals.scrollLeft + 'px';

    if(Number(deals.getBoundingClientRect().width) + Number(deals.scrollLeft) >= (Number(deals_canvas_width))) {
        deals_scroll_wrapper.classList.add('d-none');
        arrow_right_block.classList.add('d-none');
    } else {
        deals_scroll_wrapper.classList.remove('d-none');
        arrow_right_block.classList.remove('d-none');
    }
})

arrow_left_block.addEventListener('click', function () {
    let needed_scroll = Math.ceil(deals.getBoundingClientRect().width / 1.7);
    if((deals.scrollLeft - needed_scroll / 1.7) <= 0) {
        let time = 0; let step = deals.scrollLeft / 40;
        let animation_scroll = setInterval(function() { // плавное изменение скролла
            if (time <= 40) {
                deals.scrollLeft = deals.scrollLeft - Math.ceil(step);
                time++;
            } else {
                clearInterval(animation_scroll);
            }
        }, 4);
    } else {
        let time = 0; let step = needed_scroll / 40;
        let animation_scroll = setInterval(function() { // плавное изменение скролла
            if (time <= 40) {
                deals.scrollLeft = deals.scrollLeft - Math.ceil(step);
                time++;
            } else {
                clearInterval(animation_scroll);
            }
        }, 4);
    }
});

arrow_right_block.addEventListener('click', function () {
    let needed_scroll = Math.ceil(deals.getBoundingClientRect().width / 1.7);
    if(deals.getBoundingClientRect().width >= deals_list.getBoundingClientRect().width - (deals.scrollLeft + deals.getBoundingClientRect().width)) {
        needed_scroll = deals_list.getBoundingClientRect().width - (deals.scrollLeft + deals.getBoundingClientRect().width);
        let time = 0; let step = needed_scroll / 40;
        let animation_scroll = setInterval(function() { // анимация скролла
            if (time <= 40) {
                deals.scrollLeft = deals.scrollLeft + Math.ceil(step);
                time++;
            } else {
                clearInterval(animation_scroll);
            }
        }, 4);
    } else {
        let time = 0; let step = needed_scroll / 40;
        let animation_scroll = setInterval(function() { // анимация скролла
            if (time <= 40) {
                deals.scrollLeft = deals.scrollLeft + Math.ceil(step);
                time++;
            } else {
                clearInterval(animation_scroll);
            }
        }, 4);
    }
});

// scroll y
let scroll = document.getElementById('scroll');
let view_one_percent = Math.ceil(Number(deals_list.getBoundingClientRect().height) / 100);
let canvas_one_percent = Math.ceil(deals_list.scrollHeight / 100);
let canvas_percents_view = Math.ceil(Number(deals_list.getBoundingClientRect().height) / canvas_one_percent);
let scroll_line_height = view_one_percent * canvas_percents_view;
scroll.style.height = scroll_line_height + 'px';
deals_list.addEventListener('scroll', function() {
    let scrolled_top_percent = Math.ceil(deals_list.scrollTop / canvas_one_percent);
    scroll.style.marginTop = view_one_percent * scrolled_top_percent + 'px';
    showHideArrowBottom();
})

let arrow_bottom_block = document.getElementById('arrow_bottom_block');
let scroll_height = view_one_percent * 60;
arrow_bottom_block.addEventListener('click', function () {
    let time = 0; let step = scroll_height / 20;
    let animation_scroll = setInterval(function() { // анимация скролла
        if (time <= 40) {
            deals_list.scrollTop = deals_list.scrollTop + Math.ceil(step);
            showHideArrowBottom(); time++;
        } else {
            clearInterval(animation_scroll);
        }
    }, 8);
});
function showHideArrowBottom() {
    if (Number(deals_list.scrollTop+4 + Number(deals_list.getBoundingClientRect().height)) >= deals_list.scrollHeight) {
        arrow_bottom_block.classList.add('d-none');
    } else {
        arrow_bottom_block.classList.remove('d-none');
    }
}

// functions
if (modal_add_deal) {
    var add_deal_name = modal_add_deal.querySelector('.add_deal_name');
    var add_deal_phone = modal_add_deal.querySelector('.add_deal_phone');
    var add_deal_email = modal_add_deal.querySelector('.add_deal_email');
    var add_deal_product = modal_add_deal.querySelector('.add_deal_product');
    var add_deal_deadline = modal_add_deal.querySelector('.add_deal_deadline');
    var add_deal_position = modal_add_deal.querySelector('.add_deal_position');
    var add_deal_company = modal_add_deal.querySelector('.add_deal_company');
    var add_deal_price = modal_add_deal.querySelector('.add_deal_price');
    var add_deal_status = modal_add_deal.querySelector('.add_deal_status');
    var add_deal_note = modal_add_deal.querySelector('.add_deal_note');

    var change_deal_name = modal_change_deal.querySelector('.change_deal_name');
    var change_deal_phone = modal_change_deal.querySelector('.change_deal_phone');
    var change_deal_email = modal_change_deal.querySelector('.change_deal_email');
    var change_deal_product = modal_change_deal.querySelector('.change_deal_product');
    var change_deal_deadline = modal_change_deal.querySelector('.change_deal_deadline');
    var change_deal_position = modal_change_deal.querySelector('.change_deal_position');
    var change_deal_company = modal_change_deal.querySelector('.change_deal_company');
    var change_deal_price = modal_change_deal.querySelector('.change_deal_price');
    var change_deal_status = modal_change_deal.querySelector('.change_deal_status');
    var change_deal_note = modal_change_deal.querySelector('.change_deal_note');
}

let info = document.getElementById('settings_info');
let error = document.getElementById('settings_error');

let add_deal_form_error = document.getElementById('add_deal_form_error');
let change_deal_form_error = document.getElementById('change_deal_form_error');

function stageTemplate(number) {
    return '<form class="js-validation-bootstrap stage">\n' +
        '\n' +
        '                    <div class="form-group row">\n' +
        '                        <label class="col-8" for="title_'+number+'">Название <span class="text-danger">*</span></label>\n' +
        '                        <div class="col-4">\n' +
        '                            <i onclick="deleteStage()" class="si si-close js-swal-confirm stages_icon_close" data-toggle="tooltip" data-placement="left" title="Удалить"></i>\n' +
        '                        </div>\n' +
        '                        <div class="col-md-12">\n' +
        '                            <input type="text" class="form-control" id="title_'+number+'" name="title_'+number+'" placeholder="Название..">\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '\n' +
        '                    <div class="form-group row">\n' +
        '                        <label class="col-12" for="color_'+number+'">Цвет <span class="text-danger">*</span></label>\n' +
        '                        <div class="col-lg-12">\n' +
        '                            <div class="js-colorpicker input-group" data-format="hex">\n' +
        '                                <input type="text" class="form-control" id="color_'+number+'" name="color_'+number+'" value="#42a5f5">\n' +
        '                                <div class="input-group-append">\n' +
        '                                    <span class="input-group-text colorpicker-input-addon">\n' +
        '                                        <i></i>\n' +
        '                                    </span>\n' +
        '                                </div>\n' +
        '                            </div>\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '\n' +
        '                    <div class="form-group row">\n' +
        '                        <label class="col-lg-12 col-form-label" for="val-digits_'+number+'">Позиция <span class="text-danger">*</span></label>\n' +
        '                        <div class="col-lg-12">\n' +
        '                            <input type="text" class="form-control" id="val-digits_'+number+'" name="val-digits_'+number+'" placeholder="5">\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '\n' +
        '                </form>';
}

function saveStages() {
    let stages = document.getElementsByClassName('stage');

    let stages_values = [];
    for (let i=0; i < stages.length; i++) {
        let code = stages[i].getAttribute('data-code');

        let title = document.getElementById('title_'+code).value;
        let color = document.getElementById('color_'+code).value;
        let position = document.getElementById('val-digits_'+code).value;

        stages_values.push([code, title, color, position]);
    }

    if(stages.length) {
        $.ajax({
            url: '/deals/save_stages',
            type: "post",
            async: false,
            cache: false,
            data: {
                stages: stages_values
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (data) => {
                //console.log(data);

                location.reload();
            },
            error: (data) => {
                //console.log(data);

                error.innerText = 'Проверьте верность полей, все поля должны быть заполнены';
                error.classList.remove('d-none');
            }
        });
    } else {
        location.reload();
    }

}

function deleteStage(code) {
    $.ajax({
        url: '/deals/stage/'+code,
        type: "delete",
        async: false,
        cache: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: (data) => {
            //console.log(data);

            let stage = document.getElementById('stage_'+code);
            stage.remove();
        }
    });
}

$('.position').on('keyup', function(){
    $(this).val($(this).val().replace (/\D/, ''));
});

function addDeal() {
    let formData = new FormData(document.getElementById('add_deal_form'));

    $.ajax({
        url: '/deals',
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

            modal_add_deal_close.click();
            add_deal_form_error.innerText = '';
            add_deal_form_error.classList.add('d-none');
            location.reload();

            add_deal_name.value = '';
            add_deal_phone.value = '';
            add_deal_email.value = '';
            add_deal_product.value = '';
            add_deal_deadline.value = '';
            add_deal_position.value = '';
            add_deal_company.value = '';
            add_deal_price.value = '';
            add_deal_status.value = '';
            add_deal_note.value = '';
        },
        error: (data) => {
            add_deal_form_error.innerText = 'Проверьте верность введенных данных и дату';
            add_deal_form_error.classList.remove('d-none');
        }
    })
}

function changeDeal(code, next) {
    let formData = new FormData(document.getElementById('change_deal_form'));
    formData.append('next', next);
    if(change_deal_deadline.value.length > 16) {
        formData.append('deadline', change_deal_deadline.value.slice(0,16));
    }

    $.ajax({
        url: '/deals/'+code+'/update',
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

            modal_change_deal_close.click();
            change_deal_form_error.innerText = '';
            change_deal_form_error.classList.add('d-none');
            location.reload();

            change_deal_name.value = '';
            change_deal_phone.value = '';
            change_deal_email.value = '';
            change_deal_product.value = '';
            change_deal_deadline.value = '';
            change_deal_position.value = '';
            change_deal_company.value = '';
            change_deal_price.value = '';
            change_deal_status.value = '';
            change_deal_note.value = '';
        },
        error: (data) => {
            change_deal_form_error.innerText = 'Проверьте верность введенных данных и дату';
            change_deal_form_error.classList.remove('d-none');
        }
    })
}

function openDeal(data, last_stage) {
    update_deal_btn.setAttribute('onclick', "changeDeal('"+data.code+"', 'false')");
    close_deal_btn.setAttribute('onclick', "closeDeal('"+data.code+"')");

    if(last_stage) {
        next_deal_btn.classList.add('d-none');
        next_deal_btn.setAttribute('onclick', "");
    } else {
        next_deal_btn.classList.remove('d-none');
        next_deal_btn.setAttribute('onclick', "changeDeal('"+data.code+"', 'true')");
    }

    change_deal_name.value = data.name;
    change_deal_phone.value = data.phone;
    change_deal_email.value = data.email;
    change_deal_product.value = data.product;
    change_deal_deadline.value = data.deadline;
    change_deal_position.value = data.position;
    change_deal_company.value = data.company;
    change_deal_price.value = data.price;
    change_deal_status.value = data.status;
    change_deal_note.value = data.note;
}

function closeDeal(code) {
    $.ajax({
        url: '/deals/'+code,
        type: "delete",
        async: false,
        processData: false,
        contentType: false,
        cache: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: (data) => {
            //console.log(data);

            location.reload();
        }
    });
}
