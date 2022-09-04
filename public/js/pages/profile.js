/* load image  */
function adminShowImage(input) { // предворительный просмотр изображения
    let image = input.files[0];
    let reader = new FileReader(); // ридер файлов

    reader.readAsDataURL(image); // считываем файл как url

    reader.onload = function() { // выводим изображение
        let imgShowElement = document.getElementById('imgShowElement');
        imgShowElement.setAttribute('src', reader.result)
    };

    delete_image = document.getElementById('delete_image');
    delete_image.setAttribute('value', '');
}
function adminEditImg() {
    imageShowElement = document.getElementById('image_show_input').click();
}
function adminDeleteImg() {
    document.getElementById('image_show_input').value = '';
    document.getElementById('imgShowElement').setAttribute('src', '/media/avatars/avatar15.jpg');

    deleteImageDB(); // удаление изображения в бд (страница редактирования)
}
function deleteImageDB() {
    // удаление изображения в бд (страница редактирования)
    delete_image = document.getElementById('delete_image');
    delete_image.setAttribute('value', 'yes');
}

