<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Виджет "Меню частини адміністратора"
 */
class Controller_Widgets_Menuadmin extends Controller_Widgets {

    public $template = 'widgets/menuadmin_view';    // Шаблон віджета
    
    public function action_index() {
        $select = Request::initial()->controller();

        $menu = array(
            'Головна' => array('main'),
            'Матеріали' => array('pages', 'news', 'iwonder', 'wingedphrases', 'presentation','materialsteachers', 'materialsstudents'),
            'Голосування' => array('pollquestions', 'polloptions', 'pollvotes'),
            'Розклад занять' => array('schedulestalessons', 'schedulezaochlessons', 'schedulestagroups', 'schedulezaochgroups', 'schedulestateachers', 'schedulestasubject', 'schedulezaochsubjecttype', 'schedulestaaudience'),
            'Фотогалерея' => array('photogallery', 'menuphotogallery'),
            'Меню' => array('menumain', 'menumaterialsteachers', 'menumaterialsstudents'),
            'Користувачі' => array('users'),
            'Налаштування' => array('settings'),
        );

        // Вывод в шаблон
        $this->template->menu = $menu;
        $this->template->select = $select;
    }
}