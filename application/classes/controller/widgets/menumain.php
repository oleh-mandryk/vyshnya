<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Віджет "Головного меню"
 */
class Controller_Widgets_Menumain extends Controller_Widgets {
    
    public $template = 'widgets/menumain_view';

    public function action_index() {
        $select1 = Request::initial()->controller();
        $select = Request::initial()->param('page_alias');
        
        if ($select == NULL) {
            $select = Request::initial()->action();
        }
        
        $menu_main_ft = array();
        $select_it = array();
        $class_last = array();
        $menu_main = new Model_Menumain();
        
        $menu_main_ft = $menu_main->showMenuMain();
        $select_it = $menu_main->selectItemMenuMain($select, $select1);
        $class_last = $menu_main->classLast();
        
        $this->template->menu_main_ft = $menu_main_ft;
        $this->template->select_it = $select_it;
        $this->template->class_last = $class_last;
    }
}