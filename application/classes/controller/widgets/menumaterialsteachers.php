<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Методичні матеріали викладачам
 */
class Controller_Index_Menumaterialsteachers extends Controller_Index {
    
    public function action_index() {
        
        $menu_materials_teachers_ft = array();
        $menu_materials_teachers = new Model_Menumaterialsteachers();
        $menu_materials_teachers_ft = $menu_materials_teachers->showMenuMaterialsTeachers();
        
        $this->template->menu_materials_teachers_ft = $menu_materials_teachers_ft;
    }
}