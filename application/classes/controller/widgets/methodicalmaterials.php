<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Віджет "Методичні матеріали"
 */
class Controller_Widgets_Methodicalmaterials extends Controller_Widgets {
    
    public $template = 'widgets/methodicalmaterials_view';

    public function action_index() {
        $select = Request::initial()->controller();
        
        $methodicalmaterials = array(
            'Викладачам' => array('materialsteachers'),
            'Студентам стаціонару' => array('materialsstudents'),
            'Студентам заочникам' => array('materialsstudentszaoch'),
            'Додати матеріал студентам стаціонару' => array('materialsstudentsadd'),
            'Додати матеріал студентам заочникам' => array('materialsstudentszaochadd'),
        );
        
        // Вывод в шаблон
        $this->template->methodicalmaterials = $methodicalmaterials;
        $this->template->select = $select;
    }
}