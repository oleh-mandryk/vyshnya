<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Віджет "Меню для Фото"
 */
class Controller_Widgets_Menuphoto extends Controller_Widgets {

    public $template = 'widgets/menu_view';    // Шаблон віджета
    
    public function action_index() {
        $select = Request::initial()->controller();

        $menu = array(
            'Фотографії фотогалереї' => array('photogallery'),
            'Категорії фотогалереї' => array('menuphotogallery'),
        );

        // Вивід в шаблон
        $this->template->menu = $menu;
        $this->template->select = $select;
    }
}