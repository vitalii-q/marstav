let workspace = document.getElementById('workspace');
let tabs = document.getElementsByClassName('nav-link');
let add_note_btn = document.getElementById('modal-popin-plus-btn');
let select_note_btn = document.getElementById('modal-popin-select-note-btn');
let modal_close_btns = document.getElementsByClassName('modal_close_btn');
let stub = document.getElementById('workspace_stub');
//let add_note_btn_icon = document.getElementById('modal-popin-plus-close-icon');

checkTabCount();

function disableAddNoteBtn() {
    add_note_btn.setAttribute('disabled', '');
    select_note_btn.setAttribute('disabled', '');

    /**
     * tooltip подхватывает элемент только на моменте загрузки страницы
     */
    //add_note_btn_icon.setAttribute('data-toggle', 'tooltip');
    //add_note_btn_icon.setAttribute('data-placement', 'left');
    //add_note_btn_icon.setAttribute('data-original-title', 'Достигнут предел вкладок');
}

function enableAddNoteBtn() {
    add_note_btn.removeAttribute('disabled');
    select_note_btn.removeAttribute('disabled');

    //add_note_btn_icon.removeAttribute('data-toggle');
    //add_note_btn_icon.removeAttribute('data-placement');
    //add_note_btn_icon.removeAttribute('data-original-title');
}

function switchToTab(code) {
    for(let i = 0; i < tabs.length; i++) {
        if(tabs[i].getAttribute('data-tabbtnid') == code) {
            tabs[i].click();
            break;
        }
    }
}

function closeNotesModal() {
    for(let i = 0; i < modal_close_btns.length; i++) {
        modal_close_btns[i].click();
    }
}

function checkTabCount() {
    tabs = document.getElementsByClassName('nav-link');

    if (tabs.length > 0) {
        stub.classList.add('d-none');
    } else {
        stub.classList.remove('d-none');
    }

    if (tabs.length > 7) {
        disableAddNoteBtn();
    } else {
        enableAddNoteBtn();
    }
}

function checkSelectedTab(note) {
    for (let i = 0; i < tabs.length; i++) {
        if (tabs[i].getAttribute('data-tabbtnid') == note.code) {
            return tabs[i].getAttribute('data-tabbtnid');
        }
    }

    return false;
}

function checkTabsExists() {
    if (workspace.querySelectorAll('.nav-link').length === 0) {
        return false
    }

    return true;
}

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
tabs.forEach(tab => {
    addTabClickListener(tab);
});

function workspaceNoteUpdate(e) {
    let elemid = e.getAttribute('data-tabbtnid');
    let text = document.getElementById('text_'+elemid);

    let route_ajaxUpdate = e.getAttribute('data-route');

    let workspace = 1;
    if (e.getAttribute('data-dest') === 'close') {
        workspace = 0;
    }

    $.ajax({
        url: route_ajaxUpdate,
        type: "post",
        async: false,
        data: {
            text: text.value,
            workspace: workspace
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: (data) => {
            //console.log(data);
        }
    })

    if (e.classList.contains('js-animation-object')) {
        e.classList.add('flash');
        setTimeout(function () {
            e.classList.remove('flash');
        },3000, e);
    }
}

function workspaceNoteClose(e) {
    let atr_tabbtnid = e.getAttribute('data-tabbtnid')

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

    workspaceNoteUpdate(e);

    tab_button.remove();
    tab_pane.remove();

    let tab_button_active = workspace.querySelector('.nav-link.active');

    if (tab_button_active !== null) {
        tab_button_active.classList.add('active');
    } else if (checkTabsExists()) {
        let nexttablink = nexttabbtn.querySelector('.nav-link');
        nexttablink.classList.add('active');
        nexttabpane.classList.add('active');
    }

    checkTabCount();
}

function getTabBtnTemplate(note) {
    let note_title = note.title.slice(0, 14);
    if(note_title.length < note.title.length) {
        note_title = note_title+'..';
    }

    return '<li id="tab_button_'+note.code+'" class="nav-item">\n' +
        '<div id="new_tab_btn_'+note.code+'" data-tabbtnid="'+note.code+'" class="nav-link active">'+note_title+'\n' +
        '<button onclick="workspaceNoteClose(this)" type="button" class="btn-block-option btn-block-option-tab" data-tabbtnid="'+note.code+'"data-route="/notes/folder/'+note.code+'/update/ajax" data-dest="close">\n' +
        '<i class="si si-close"></i>\n' +
        '</button>\n' +
        '</div>\n' +
        '</li>';
}

function getTabPaneTemplate(note) {
    let note_text = '';
    if (note.text !== null) {
        note_text = note.text;
    }

    return '<div class="tab-pane active " id="tab_pane_'+note.code+'" role="tabpanel">\n' +
        '<div class="form-group row">\n' +
        '<div class="col-12">\n' +
        '<div class="form-material pt-0">\n' +
        '<textarea class="form-control" id="text_'+note.code+'" name="text_'+note.code+'" rows="18" placeholder="Начните писать" maxlength="4000">'+note_text+'</textarea>\n' +
        '</div>\n' +
        '</div>\n' +
        '</div>\n' +
        '<div class="form-group row">\n' +
        '<div class="col-3 ml-auto">\n' +
        '<button data-route="/notes/folder/'+note.code+'/update/ajax" data-tabbtnid="'+note.code+'" onclick="workspaceNoteUpdate(this)" class="btn btn-block btn-alt-primary js-animation-object animated" data-animation-class="flash">\n' +
        '<i class="si si-check mr-5"></i> Сохранить\n' +
        '</button>\n' +
        '</div>\n' +
        '</div>\n' +
        '</div>';
}

function addNoteToWorkspace(note) {
    if (checkTabsExists()) {
        workspace.querySelector('.nav-link.active').classList.remove('active');
        workspace.querySelector('.tab-pane.active').classList.remove('active');
    }

    let block_options = $('#block_options');
    $(block_options).before(getTabBtnTemplate(note));

    let tab_content = $('#tab_content');
    $(tab_content).append(getTabPaneTemplate(note));

    // Добавляем слушатель на новый элемент
    let new_tab = document.getElementById('new_tab_btn_'+note.code);
    addTabClickListener(new_tab);

    closeNotesModal();
}

function addFirstNoteBtn() {
    closeNotesModal();
    add_note_btn.click();
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
            success: (note) => {
                addNoteToWorkspace(note);

                title_input.value = '';
                let select_options = folder_selector.getElementsByTagName('option');
                for (let i = 0; i < select_options.length; i++) {
                    if (select_options[i].value === 'root') select_options[i].selected = true;
                }

                checkTabCount();
            }
        })
    }
}

function selectNote(note) {
    note_code = note.getAttribute('data-code');

    $.ajax({
        url: '/notes/show/ajax',
        type: "post",
        async: false,
        data: {
            note_code: note_code,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: (note) => {
            let existingTabCode = checkSelectedTab(note);
            if(!existingTabCode) {
                addNoteToWorkspace(note);
                checkTabCount();
            } else {
                switchToTab(existingTabCode);
                closeNotesModal();
            }
        }
    })
}

// note selector
let notes_tree = document.getElementsByClassName('ws_tree_note');
notes_tree.forEach(note => {
    note.addEventListener(("click"), function() {
        selectNote(note);
    });
});
