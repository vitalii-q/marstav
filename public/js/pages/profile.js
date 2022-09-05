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



/* leave company modal plugin */
class BeUIActivity {
    static barsRandomize() {
        jQuery('.js-bar-randomize').on('click', e => {
            jQuery(e.currentTarget)
                .parents('.block')
                .find('.progress-bar')
                .each((index, element) => {
                    let el      = jQuery(element);
                    let random  = Math.floor((Math.random() * 91) + 10);

                    // Update progress width
                    el.css('width', random  + '%');

                    // Update progress label
                    jQuery('.progress-bar-label', el).html(random  + '%');
                });
        });
    }

    static sweetAlert2() {
        let toast = Swal.mixin({
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-alt-success m-5',
                cancelButton: 'btn btn-alt-danger m-5',
                input: 'form-control'
            }
        });
        jQuery('.js-swal-confirm').on('click', e => {
            toast.fire({
                title: 'Вы уверены?',
                text: 'Действие не обратимо!',
                icon: 'warning',
                showCancelButton: true,
                customClass: {
                    confirmButton: 'btn btn-alt-danger m-1',
                    cancelButton: 'btn btn-alt-secondary m-1'
                },
                confirmButtonText: 'Да, подтверждаю!',
                html: false,
                preConfirm: e => {
                    return new Promise(resolve => {
                        setTimeout(() => {
                            resolve();
                        }, 50);
                    });
                }
            }).then(result => {
                if (result.value) {
                    $.ajax({
                        url: '/profile/leave_сompany',
                        type: "post",
                        async: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (data) => {
                            //console.log(data);

                            location.reload();
                        }
                    })
                }
            });
        });
    }

    static init() {
        this.barsRandomize();
        this.sweetAlert2();
    }
}
jQuery(() => { BeUIActivity.init(); });
