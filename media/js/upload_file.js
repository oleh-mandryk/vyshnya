$(function(){
        $('#one').MultiFile({
          accept:'doc', max:1, STRING: {
            remove:'<img src="/media/img/delete.png"> ',
            selected:'Вибрані: $file',
            denied:'Неправильний тип файлу: $ext!',
            duplicate:'Цей файл вже вибраний:\n$file!'
        }});
    });

$(function(){
        $('#multi').MultiFile({
          accept:'zip', max:1, STRING: {
            remove:'<img src="/media/img/delete.png"> ',
            selected:'Вибрані: $file',
            denied:'Неправильний тип файлу: $ext!',
            duplicate:'Цей файл вже вибраний:\n$file!'
        }});
    });
