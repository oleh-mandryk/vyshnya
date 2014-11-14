<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Віджет "Меню Голосування"
 */
class Controller_Widgets_Menupolls extends Controller_Widgets {

    public $template = 'widgets/menu_view';    // Шаблон віджета
    
    public function action_index() {
        $select = Request::initial()->controller();

        $menu = array(
            'Запитання' => array('pollquestions'),
            'Відповіді' => array('polloptions'),
            'Результати голосування' => array('pollvotes'),
	    'Розсилка' => array('newsletter'),
        );

        // Вивід в шаблон
        $this->template->menu = $menu;
        $this->template->select = $select;
    }
}