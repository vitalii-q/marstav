function workspaceNoteUpdate(e) {
    let elemid = e.getAttribute('data-elemid');
    let text = document.getElementById('text_'+elemid);

    let route_ajaxUpdate = e.getAttribute('data-route');

    $.ajax({
        url: route_ajaxUpdate,
        type: "post",
        async: false,
        data: {
            text: text.value
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: (data) => {
            //console.log(data);
        }
    })
}

function workspaceNoteClose(tab_button_id) {
    let atr_tabbtnid = tab_button_id.getAttribute('data-tabbtnid')

    let tabbtnid = 'tab_button_'+atr_tabbtnid;
    let tabpaneid = 'tab_pane_'+atr_tabbtnid;
    let tab_button = document.getElementById(tabbtnid);
    let tab_pane = document.getElementById(tabpaneid);

    let nexttabbtn = tab_button.nextSibling.nextElementSibling;
    let nexttabpane = tab_pane.nextSibling.nextElementSibling;
    if (nexttabbtn.id === '') {
        nexttabbtn = tab_button.previousElementSibling;
        nexttabpane = tab_pane.previousElementSibling;
    }

    tab_button.remove();
    tab_pane.remove();

    let workspace = document.getElementById('workspace');
    let tab_button_active = workspace.querySelector('.nav-link.active');

    if (tab_button_active !== null) {
        tab_button_active.classList.add('active');
    } else {
        let nexttablink = nexttabbtn.querySelector('.nav-link');
        nexttablink.classList.add('active');
        nexttabpane.classList.add('active');
    }
}

function workspaceNoteAdd() {
    let new_tabbtncode = 'zametkaR';


    console.log(new_tabbtncode);


    /*let tab_btn_empty =
        '<li id="tab_button_" class="nav-item">\n' +
        '<a href="#tab_pane_" class="nav-link active">\n' +
        '<div class="opacity-0"></div>\n' +
        '<div class="nav-link_tclicker"></div>\n' +
        '<button data-tabbtnid="" onclick="workspaceNoteClose(this)" type="button" class="btn-block-option btn-block-option-tab">\n' +
        '<i class="si si-close"></i>\n' +
        '</button>\n' +
        '</a>\n' +
        '</li>';

    let tab_pane_empty =
        '<div class="tab-pane active" id="tab_pane_{{ $note->code }}" role="tabpanel">\n' +
        '<div class="form-group row">\n' +
        '<div class="col-12">\n' +
        '<div class="form-material pt-0">\n' +
        '<textarea class="form-control" id="text_{{ $note->code }}" name="text_{{ $note->code }}" rows="16" maxlength="4000" placeholder="Начните писать">{{ $note->text }}</textarea>\n' +
        '</div>\n' +
        '</div>\n' +
        '</div>\n' +
        '\n' +
        '<div class="form-group row">\n' +
        '<div class="col-3 ml-auto">\n' +
        '<button data-route="/notes/folder/{{ $note->code }}/update/ajax" data-elemid="{{ $note->code }}" onclick="workspaceNoteUpdate(this)" class="btn btn-block btn-alt-primary">\n' +
        '<i class="fa fa-refresh mr-5"></i> Обновить\n' +
        '</button>\n' +
        '<button type="submit" class="btn btn-alt-primary w-100">Сохранить</button>\n' +
        '</div>\n' +
        '</div>\n' +
        '</div>';

    let workspace = document.getElementById('workspace');
    workspace.querySelector('.nav-link.active').classList.remove('active');
    workspace.querySelector('.tab-pane.active').classList.remove('active');

    let block_options = $('#block_options');
    $(block_options).before(tab_btn_empty);

    let tab_content = $('#tab_content');
    $(tab_content).append(tab_pane_empty);*/




    //console.log(tab_pane_empty);
    //console.log(block_options);
}
