let stage_more = document.getElementById('stage_more');

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
            console.log(data);
        },
        error: (data) => {
            console.log(data);
            console.log('Заполните все поля');
        }
    });
}

function deleteStage() {

}

$('.position').on('keyup', function(){
    $(this).val($(this).val().replace (/\D/, ''));
});
