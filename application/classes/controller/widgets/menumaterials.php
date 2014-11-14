<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Віджет "Меню матеріалів"
 */
class Controller_Widgets_Menumaterials extends Controller_Widgets {

    public $template = 'widgets/menu_view';    // Шаблон віджета
    
    public function action_index() {
        $select = Request::initial()->controller();

        $menu = array(
            'Сторінки' => array('pages'),
            'Новини' => array('news'),
            'Цікаво знати' => array('iwonder'),
            'Крилаті фрази' => array('wingedphrases'),
            'Презентація' => array('presentation'),
            'Мет.матер. викладачам' => array('materialsteachers'),
            'Мет.матер.студ.стаціонару' => array('materialsstudents'),
            'Мет.матер.студ.заочникам' => array('materialsstudentszaoch'),
        );

        // Вивід в шаблон
        $this->template->menu = $menu;
        $this->template->select = $select;
    }
}