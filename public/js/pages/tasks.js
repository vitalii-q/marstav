function inputFilesCountNotification() {
    let files = document.getElementById('files');
    let notification = document.getElementById('files_info');
    let error = document.getElementById('files_error');

    let text;
    if (files.files.length == 0 || files.files.length == 5 || files.files.length == 6 || files.files.length == 7 || files.files.length == 8
        || files.files.length == 9 || files.files.length == 10) {
        text = 'Вы прикрепили '+files.files.length+' файлов';

        filesNotificationInfoShow(notification, error, text)
    } else if (files.files.length == 1) {
        text = 'Вы прикрепили 1 файл';

        filesNotificationInfoShow(notification, error, text)
    } else if (files.files.length == 2 || files.files.length == 3 || files.files.length == 4) {
        text = 'Вы прикрепили '+files.files.length+' файла';

        filesNotificationInfoShow(notification, error, text)
    } else if (files.files.length > 10) {
        text = 'Вы можете прикрепить не более 10 файлов';

        error.innerText = text;
        notification.classList.add('d-none');
        error.classList.remove('d-none');
    }
}

function filesNotificationInfoShow(notification, error, text) {
    notification.innerText = text;
    error.classList.add('d-none');
    notification.classList.remove('d-none');
}
