let page_container = document.getElementById('page-container');

function changeTheme(theme) {
    $.ajax({
        url: '/settings/change_theme',
        type: 'post',
        async: false,
        data: {
            theme: theme
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: (data) => {
            //console.log(data);
        }
    });
}

function changeHeaderStyle() {
    if (page_container.classList.contains('page-header-modern')) {
        page_container.classList.remove('page-header-modern');
    } else {
        page_container.classList.add('page-header-modern');
    }

    $.ajax({
        url: '/settings/change_header_style',
        type: 'post',
        async: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: (data) => {
            //console.log(data);
        }
    });
}

function changeHeaderMode() {
    $.ajax({
        url: '/settings/change_header_mode',
        type: 'post',
        async: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: (data) => {
            //console.log(data);
        }
    });
}

function changeSidebarStyle(style) {
    $.ajax({
        url: '/settings/change_sidebar_style',
        type: 'post',
        async: false,
        data: {
            style: style
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: (data) => {
            console.log(data);
        }
    });
}
