<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Віджет "Меню профілю"
 */
class Controller_Widgets_Menuaccount extends Controller_Widgets {

    public $template = 'widgets/menuaccount_view'; // Шаблон віджета
    
    public function action_index() {
        $select = Request::initial()->action();

        $menu = array(
            'Профіль' => array('index'),
            'Редагування профілю' => array('profile'),
            'Вихід' => array('logout'),
        );

        // Вывод в шаблон
        $this->template->menu = $menu;
        $this->template->select = $select;
    }
}