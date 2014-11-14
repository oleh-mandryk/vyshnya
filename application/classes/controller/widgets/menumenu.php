<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Віджет "Меню для Меню"
 */
class Controller_Widgets_Menumenu extends Controller_Widgets {

    public $template = 'widgets/menu_view';    // Шаблон віджета
    
    public function action_index() {
        $select = Request::initial()->controller();

        $menu = array(
            'Головне меню' => array('menumain'),
            'Меню для метод.матер.викладачу' => array('menumaterialsteachers'),
            'Меню для метод.матер.студентам стаціонару' => array('menumaterialsstudents'),
            'Меню для метод.матер.студентам заочникам' => array('menumaterialsstudentszaoch'),
        );

        // Вивід в шаблон
        $this->template->menu = $menu;
        $this->template->select = $select;
    }
}