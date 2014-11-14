<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Методичні матеріали викладачам
 */
class Controller_Index_Materialsstudents extends Controller_Index {
    
    public function before() {
        parent::before();
        
        $ses_url = Request::initial()->url();
        $this->session->delete('admin_red');
        $this->session->set('admin_red', $ses_url); //Записуємо сесію
        
        $this->template->styles[] = 'media/css/materials.css';
        $this->template->scripts[] = 'media/js/select.js';
        $this->template->scripts[] = 'media/js/select_run.js';
    }
    
    public function action_index() {
        
        $menu_materials_students_ft = array();
        $menu_materials_students = new Model_Menumaterialsstudents();
        $menu_materials_students_ft = $menu_materials_students->showMenuMaterialsStudents();
        
        $content = View::factory('index/materials_students/materials_students_menu_view', array(
            'menu_materials_students_ft' => $menu_materials_students_ft,
        ));
        
        // Виводимо в шаблон
        $this->template->title = 'Методичні матеріали студентам стаціонару';
        $this->template->page_title = 'Методичні матеріали студентам стаціонару';
        $this->template->block_content = array($content);
    }
    
    public function action_show() {
        
        $auth = Auth::instance();
        
        if (isset($_POST['material']))
        {
            $id = $_POST['material'];
            
        }
        else
        {
            // Зчитуємо дані з сесії
            $id = $this->session->get('id_ses');
        }
        
        if (!isset ($id_ses))
        {
            // Встановити дані
            $this->session->set('id_ses', $id);
        }
        
        
        $title_mat = ORM::factory('menumaterialsstudents', $id); 
                
        $materials_students = new Model_Materialsstudents();
        
        $count = $materials_students->countMaterialsStudents($id);
        
        if((!$title_mat->loaded()) or ($id == null) or ($count==0)){
            throw new HTTP_Exception_404('Методичних матеріалів не знайдено');
            return;
        }
        
        $pagination = Pagination::factory(array(
            'total_items' => $count,
        ));
        
        $materials_students_all = $materials_students->showMaterialsStudents($id, $pagination);
        
        $content = View::factory('index/materials_students/materials_students_show_view', array(
                'materials_students_all' => $materials_students_all,
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