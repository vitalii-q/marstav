function addTabClickListener(tab) {
    tab.addEventListener(("click"), function(e) {
        if (e.target.classList.contains('nav-link')) {
            let atr_tabbtnid = tab.getAttribute('data-tabbtnid');
            let panes = document.getElementsByClassName('tab-pane');
            panes.forEach(pane => {
                if(pane.id === 'tab_pane_'+atr_tabbtnid) {
                    pane.classList.add('active');
                } else {
                    pane.classList.remove('active');
                }
            });

            for (let i = 0; i < tabs.length; i++) {
                if (tabs[i] === tab) {
                    tabs[i].classList.add('active');
                } else {
                    tabs[i].classList.remove('active');
                }
            }
        }
    });
}

// tabs switcher
let tabs = document.getElementsByClassName('nav-link');
tabs.forEach(tab => {
    addTabClickListener(tab);
});

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

    let nexttabbtn = tab_button.nextElementSibling;
    let nexttabpane = tab_pane.nextElementSibling;
    if (nexttabpane === null) {
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

function getTabBtnTemplate(note_code) {
    return '<li id="tab_button_'+note_code+'" class="nav-item">\n' +
        '<div id="new_tab_btn_'+note_code+'" data-tabbtnid="'+note_code+'" class="nav-link active">'+note_code+'\n' +
        '<button data-tabbtnid="'+note_code+'" onclick="workspaceNoteClose(this)" type="button" class="btn-block-option btn-block-option-tab">\n' +
        '<i class="si si-close"></i>\n' +
        '</button>\n' +
        '</div>\n' +
        '</li>';
}

function getTabPaneTemplate(note_code) {
    return '<div class="tab-pane active " id="tab_pane_'+note_code+'" role="tabpanel">\n' +
        '<div class="form-group row">\n' +
        '<div class="col-12">\n' +
        '<div class="form-material pt-0">\n' +
        '<textarea class="form-control" id="text_'+note_code+'" name="text_'+note_code+'" rows="18" placeholder="Начните писать" maxlength="4000">'+note_code+'</textarea>\n' +
        '</div>\n' +
        '</div>\n' +
        '</div>\n' +
        '<div class="form-group row">\n' +
        '<div class="col-3 ml-auto">\n' +
        '<button data-route="/notes/folder/'+note_code+'/update/ajax" data-elemid="'+note_code+'" onclick="workspaceNoteUpdate(this)" class="btn btn-block btn-alt-primary">\n' +
        '<i class="si si-check mr-5"></i> Сохранить\n' +
        '</button>\n' +
        '</div>\n' +
        '</div>\n' +
        '</div>';
}

function workspaceNoteAdd() {
    let title_input = document.getElementById('ws_add_note_title');
    let folder_selector = document.getElementById('ws_add_note_folder');

    let error = document.getElementById('ws_add_note_title_error');
    if(title_input.value.length < 1) {
        error.innerHTML = 'Введите название';
        error.classList.remove('d-none');
    } else if (title_input.value.length > 255) {
        error.innerHTML = 'Слишком длинное название';
        error.classList.remove('d-none');
    } else {
        error.innerHTML = '';
        error.classList.add('d-none');

        $.ajax({
            url: '/notes/store/ajax',
            type: "post",
            async: false,
            data: {
                folder_code: folder_selector.value,
                title: title_input.value
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: () => {
                //console.log(note_code);
                let note_code = 'test'+Math.random();

                /*let tab_btn_empty =
                    '<li id="tab_button_'+note_code+'" class="nav-item">\n' +
                    '<a href="#tab_pane_'+note_code+'" class="nav-link active">\n' +
                    '<div class="opacity-0">title</div>\n' +
                    '<div class="nav-link_tclicker">title</div>\n' +
                    '<button data-tabbtnid="'+note_code+'" onclick="workspaceNoteClose(this)" type="button" class="btn-block-option btn-block-option-tab">\n' +
                    '<i class="si si-close"></i>\n' +
                    '</button>\n' +
                    '</a>\n' +
                    '</li>';*/

                /*let tab_pane_empty =
                    '<div class="tab-pane active" id="tab_pane_'+note_code+'" role="tabpanel">\n' +
                    '<div class="form-group row">\n' +
                    '<div class="col-12">\n' +
                    '<div class="form-material pt-0">\n' +
                    '<textarea class="form-control" id="text_'+note_code+'" name="text_'+note_code+'" rows="16" maxlength="4000" placeholder="Начните писать"></textarea>\n' +
                    '</div>\n' +
                    '</div>\n' +
                    '</div>\n' +
                    '\n' +
                    '<div class="form-group row">\n' +
                    '<div class="col-3 ml-auto">\n' +
                    '<button data-route="/notes/folder/'+note_code+'/update/ajax" data-elemid="'+note_code+'" onclick="workspaceNoteUpdate(this)" class="btn btn-block btn-alt-primary">\n' +
                    '<i class="fa fa-refresh mr-5"></i> Обновить\n' +
                    '</button>\n' +
                    '<button type="submit" class="btn btn-alt-primary w-100">Сохранить</button>\n' +
                    '</div>\n' +
                    '</div>\n' +
                    '</div>';*/

                /*let tab_btn_empty =
                    '<li id="tab_button_'+note_code+'" class="nav-item">\n' +
                    '<a href="#tab_pane_'+note_code+'" class="nav-link active">\n' +
                    '<div class="opacity-0">title</div>\n' +
                    '<div class="nav-link_tclicker">title</div>\n' +
                    '<button data-tabbtnid="'+note_code+'" onclick="workspaceNoteClose(this)" type="button" class="btn-block-option btn-block-option-tab">\n' +
                    '<i class="si si-close"></i>\n' +
                    '</button>\n' +
                    '</a>\n' +
                    '</li>';*/

                /*let tab_btn_empty =
                    //'<a href="#tab_pane_'+note_code+'" class="nav-link active">\n' +
                    '<div class="opacity-0">title</div>\n' +
                    '<div class="nav-link_tclicker">title</div>\n' +
                    '<button data-tabbtnid="'+note_code+'" onclick="workspaceNoteClose(this)" type="button" class="btn-block-option btn-block-option-tab">\n' +
                    '<i class="si si-close"></i>\n' +
                    '</button>';*/
                    //'</a>';

                /*let tab_pane_empty =
                    '<div class="tab-pane active " id="tab_pane_'+note_code+'" role="tabpanel">\n' +
                    '<div class="form-group row">\n' +
                    '<div class="col-12">\n' +
                    '<div class="form-material pt-0">\n' +
                    '<textarea class="form-control" id="text_'+note_code+'" name="text_'+note_code+'" rows="18" placeholder="Начните писать" maxlength="4000">text</textarea>\n' +
                    '</div>\n' +
                    '</div>\n' +
                    '</div>\n' +
                    '<div class="form-group row">\n' +
                    '<div class="col-3 ml-auto">\n' +
                    '<button data-route="/notes/folder/'+note_code+'/update/ajax" data-elemid="'+note_code+'" onclick="workspaceNoteUpdate(this)" class="btn btn-block btn-alt-primary">\n' +
                    '<i class="si si-check mr-5"></i> Сохранить\n' +
                    '</button>\n' +
                    '</div>\n' +
                    '</div>\n' +
                    '</div>';*/

                /*let tab_pane_empty =
                    '<div class="form-group row">\n' +
                    '<div class="col-12">\n' +
                    '<div class="form-material pt-0">\n' +
                    '<textarea class="form-control" id="text_'+note_code+'" name="text_'+note_code+'" rows="18" placeholder="Начните писать" maxlength="4000">'+note_code+'</textarea>\n' +
                    '</div>\n' +
                    '</div>\n' +
                    '</div>\n' +
                    '\n' +
                    '<div class="form-group row">\n' +
                    '<div class="col-3 ml-auto">\n' +
                    '<button data-route="/notes/folder/'+note_code+'/update/ajax" data-elemid="'+note_code+'" onclick="workspaceNoteUpdate(this)" class="btn btn-block btn-alt-primary">\n' +
                    '<i class="si si-check mr-5"></i> Сохранить\n' +
                    '</button>\n' +
                    '</div>\n' +
                    '</div>';*/

                let workspace = document.getElementById('workspace');
                workspace.querySelector('.nav-link.active').classList.remove('active');
                workspace.querySelector('.tab-pane.active').classList.remove('active');

                let block_options = $('#block_options');
                //let block_options = document.getElementById('block_options');

                $(block_options).before(getTabBtnTemplate(note_code));
                /*let parentDiv = document.getElementById('tabs_ul');
                let elem = document.createElement("li");
                elem.classList.add('nav-item');
                //elem.setAttribute('id', 'tab_button_'+note_code);
                elem.id = 'tab_button_'+note_code;

                let aq = document.createElement("a");
                aq.classList.add('nav-link');
                aq.classList.add('active');
                aq.setAttribute('href', '#tab_pane_'+note_code);

                aq.innerHTML = tab_btn_empty;
                elem.appendChild(aq);
                console.log(elem);

                //console.log(elem);
                //<a href="#tab_pane_'+note_code+'" class="nav-link active">
                parentDiv.insertBefore(elem, parentDiv.lastElementChild);
                //console.log(elem);*/


                let tab_content = $('#tab_content');
                //let tab_content = document.getElementById('tab_content');

                $(tab_content).append(getTabPaneTemplate(note_code));
                /*let parentContent = document.getElementById('tab_content');
                let elem_content = document.createElement("div");
                elem_content.classList.add('tab-pane');
                elem_content.classList.add('active');
                //elem_content.setAttribute('id', 'tab_pane_'+note_code);
                elem_content.id = 'tab_pane_'+note_code;
                elem_content.innerHTML = tab_pane_empty;
                console.log(elem_content);
                //parentContent.insertBefore(elem_content, parentContent.lastElementChild);
                parentContent.appendChild(elem_content);*/


                // Добавляем слушатель на новый элемент
                let new_tab = document.getElementById('new_tab_btn_'+note_code);
                addTabClickListener(new_tab);


                /*title_input.value = '';
                let select_options = folder_selector.getElementsByTagName('option');
                for (let i = 0; i < select_options.length; i++) {
                    if (select_options[i].value === 'root') select_options[i].selected = true;
                }*/
            }
        })
    }



    //console.log(title);


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
