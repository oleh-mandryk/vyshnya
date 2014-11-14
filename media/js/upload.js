$(function(){
        $('#multi').MultiFile({
          accept:'jpg|gif|bmp|png', max:1, STRING: {
            remove:'<img src="/media/img/delete.png"> ',
            selected:'Вибрані: $file',
            denied:'Неправильний тип файлу: $ext!',
            duplicate:'Цей файл вже вибраний:\n$file!'
        }});
    });