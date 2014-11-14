<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Віджет "Розклад"
 */
class Controller_Widgets_Schedule extends Controller_Widgets {
    
    public $template = 'widgets/schedule_view';

    public function action_index() {
        $select = Request::initial()->controller();
        
        $schedule = array(
            'Студентам стаціонару' => array('schedulesta'),
            'Викладачам стаціонару' => array('schedulestateachers'),
            'Зміни до розкладу' => array('/media/files/schedule/schedule_changes.doc'),
            'Студентам заочникам' => array('schedulezaoch'),
            'Викладачам заочників' => array('schedulezaochteachers'),
        );
        
        // Вывод в шаблон
        $this->template->schedule = $schedule;
        $this->template->select = $select;
    }
}