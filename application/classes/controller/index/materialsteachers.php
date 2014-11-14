<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Методичні матеріали викладачам
 */
class Controller_Index_Materialsteachers extends Controller_Index {
    
    public function before() {
        parent::before();
        
        $ses_url = Request::initial()->url();
        $this->session->delete('admin_red');
        $this->session->set('admin_red', $ses_url); //Записуємо сесію
        
        $this->template->styles[] = 'media/css/materials.css';
    }
    
    public function action_index() {
        
        $menu_materials_teachers_ft = array();
        $menu_materials_teachers = new Model_Menumaterialsteachers();
        $menu_materials_teachers_ft = $menu_materials_teachers->showMenuMaterialsTeachers();
        
        $content = View::factory('index/materials_teachers/materials_teachers_menu_view', array(
            'menu_materials_teachers_ft' => $menu_materials_teachers_ft,
        ));
        
        // Виводимо в шаблон
        $this->template->title = 'Методичні матеріали викладачам';
        $this->template->page_title = 'Методичні матеріали викладачам';
        $this->template->block_content = array($content);
    }
    
    public function action_show() {
        
        $auth = Auth::instance();
        
        $id = (int) $this->request->param('id');
        
        $title_mat = ORM::factory('menumaterialsteachers', $id); 
                
        $materials_teachers = new Model_Materialsteachers();
        
        $count = $materials_teachers->countMaterialsTeachers($id);
        
        if((!$title_mat->loaded()) or ($id == null) or ($count==0)){
            throw new HTTP_Exception_404('Методичних матеріалів не знайдено');
            return;
        }
        
        $pagination = Pagination::factory(array(
            'total_items' => $count,
        ));
        
        $materials_teachers_all = $materials_teachers->showMaterialsTeachers($id, $pagination);
        
        $content = View::factory('index/materials_teachers/materials_teachers_show_view', array(
                'materials_teachers_all' => $materials_teachers_all,
                'pagination' => $pagination,
                'auth' => $auth,
                'user' => $auth->get_user(),
        ));
        
        // Виводимо в шаблон
        $this->template->title = $title_mat->title;
        $this->template->page_title = $title_mat->title;
        $this->template->block_content = array($content);
    }
}