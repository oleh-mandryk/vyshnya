<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Віджет "Меню Розкладу занять"
 */
class Controller_Widgets_Menuschedule extends Controller_Widgets {

    public $template = 'widgets/menu_view';    // Шаблон віджета
    
    public function action_index() {
        $select = Request::initial()->controller();

        $menu = array(
            'Пари для стаціонару' => array('schedulestalessons'),
            'Пари для заочників' => array('schedulezaochlessons'),
            'Стаціонарні групи' => array('schedulestagroups'),
            'Заочні групи' => array('schedulezaochgroups'),
            'Викладачі' => array('schedulestateachers'),
            'Предмети' => array('schedulestasubject'),
            'Атрибут до предмету' => array('schedulezaochsubjecttype'),
            'Аудиторії' => array('schedulestaaudience'),
        );

        // Вивід в шаблон
        $this->template->menu = $menu;
        $this->template->select = $select;
    }
}