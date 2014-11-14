<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Методичні матеріали викладачам
 */
class Controller_Admin_Materialsteachers extends Controller_Admin {

    public function before() {
        parent::before();
        $this->template->scripts[] = 'media/js/jquery-1.6.2.min.js';
        $this->template->scripts[] = 'media/js/jquery.MultiFile.pack.js';
        $this->template->scripts[] = 'media/js/upload_file.js';
        $this->template->scripts[] = 'media/js/select.js';
        $this->template->scripts[] = 'media/js/select_add.js';
        
        // Вивід в шаблон
        $this->template->submenu = Widget::load('menumaterials');
        $this->template->page_title = 'Методичні матеріали викладачам';
        $this->template->title = 'Методичні матеріали викладачам';
    }
    
    public function action_index() {
        
        $count = ORM::factory('materialsteachers')->count_all();
            
        $pagination = Pagination::factory(array(
            'total_items' => $count,
            'items_per_page' => 20))
            
            ->route_params( array(
                'controller' => Request::current()->controller(),
                'action' => Request::current()->action(),
            ));
    
        $materials_teachers = ORM::factory('materialsteachers')
            ->order_by('id','desc')
            ->limit($pagination->items_per_page)
            ->offset($pagination->offset)
            ->find_all();

        $info_ok = $this->session->get('message_admin');
        
        $content = View::factory('admin/materials_teachers/materials_teachers_index_view', array (
            'materials_teachers' => $materials_teachers,
            'pagination' => $pagination,
            'info_ok' => $info_ok,
            
        ));
        
        $this->session->delete('message_admin');

        // Вивід в шаблон
        $this->template->block_main_content = array($content);
    }
    
    // Додати
    public function action_add() {
        
        // Отримання всіх головних пунктів
        $menu_materials_teachers_all = ORM::factory('menumaterialsteachers')
            ->where('lvl','=', 1)
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();
        
        $menu_materials_teachers_ad = array();
            foreach ($menu_materials_teachers_all as $menu){
                $menu_materials_teachers_ad[$menu->id] = $menu->title;
            }
            
        // Отримання всіх підпунктів меню
        $menu_pid_all = ORM::factory('menumaterialsteachers')
            ->where('lvl','=', 2)
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();
        
        if (isset($_POST['submit'])) {
        
            $data = Arr::extract($_POST, array('title', 'intro', 'author', 'url_material', 'date','menu_id', 'menu_materials_teachers_id','publish_id'));
            $materials_teachers = ORM::factory('materialsteachers');
            $materials_teachers->values($data);
            $validate = Validation::factory($_FILES);
                    $validate->rule('url_material', 'Upload::valid');
                    $validate->rule('url_material', 'Upload::type', array(':value', array('zip')));
                    $validate->rule('url_material', 'Upload::size', array(':value', '2M'));
            
            if ($validate->check()) {
                $kkk = 1;
            }
            else {
                $errors_cap = $validate->errors('upload');
                $kkk = 0;
            }
            
            try {
                $jjj =1;
                $materials_teachers->url_material = $_FILES['url_material']['name'];
                $materials_teachers->check();
                
            }
            catch (ORM_Validation_Exception $e) {
                $jjj = 0;
                $errors = $e->errors('validation');
            }
            
            if (($jjj!= 0)and($kkk == 1)) { 
                $directory = 'media/files/materials_teachers';
                // Запис в БД
                $materials_teachers->menu_materials_teachers_id = $_POST['menu_materials_teachers_id'];
                $materials_teachers->save();
                Upload::save($_FILES['url_material'], $_FILES['url_material']['name'], $directory, 0777);
                
                $ses_ok = Kohana::message('message', 'add');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                    
                $this->request->redirect('admin/materialsteachers');
            }
        }
        
        $content = View::factory('admin/materials_teachers/materials_teachers_add_view')
            ->bind('errors', $errors)
            ->bind('errors_cap', $errors_cap)
            ->bind('data', $data)
            ->bind('menu_materials_teachers_ad', $menu_materials_teachers_ad)
            ->bind('menu_pid_all',$menu_pid_all);
        
        // Вивід в шаблон
        $this->template->page_title .= ' :: Додати';
        $this->template->title .= ' :: Додати';
        $this->template->block_main_content = array($content);
    }
    
    public function action_edit() {
        
        $id = (int) $this->request->param('id');
        if(!$id) {
            $this->request->redirect('admin/materialsteachers');
        }
        
        // Отримання всіх головних пунктів
        $menu_materials_teachers_all = ORM::factory('menumaterialsteachers')
            ->where('lvl','=', 1)
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();
        
        $menu_materials_teachers_ad = array();
            foreach ($menu_materials_teachers_all as $menu){
                $menu_materials_teachers_ad[$menu->id] = $menu->title;
        }
        
        // Отримання всіх підпунктів меню
        $menu_pid_all = ORM::factory('menumaterialsteachers')
            ->where('lvl','=', 2)
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();
                                
        $materials_teachers = ORM::factory('materialsteachers', $id);
        $file_del = $materials_teachers->url_material;
        $data = $materials_teachers->as_array();
        
        $data['menu_id'] = $materials_teachers->menu->parent()->id;
        $data['menu_materials_teachers_id'] = $materials_teachers->menu->id;
        
        // Редагування
        if (isset($_POST['submit'])) {
        
            $data = Arr::extract($_POST, array('title', 'intro', 'author', 'date', 'url_material', 'menu_id', 'menu_materials_teachers_id', 'publish_id'));
            $data['url_material'] =  $materials_teachers->url_material;
            $materials_teachers->values($data);
            $validate = Validation::factory($_FILES);
                $validate->rule('url_material', 'Upload::valid');
                $validate->rule('url_material', 'Upload::type', array(':value', array('zip')));
                $validate->rule('url_material', 'Upload::size', array(':value', '2M'));
            
            if ($validate->check()) {
                $kkk = 1;
            }
            else {
                $errors_cap = $validate->errors('upload');
                $kkk = 0;
            }
            
            try {
                $jjj =1;
                if (empty($_FILES['url_material']['name']))
                {
                    $materials_teachers->url_material = $file_del;
                }
                else {
                    $materials_teachers->url_material = $_FILES['url_material']['name'];
                }
                
                $materials_teachers->check();
            }
            catch (ORM_Validation_Exception $e) {
                $jjj = 0;
                $errors = $e->errors('validation');
            }
            
            if (($jjj!= 0)and($kkk == 1)) {
                
                // Запис в БД
                $materials_teachers->menu_materials_teachers_id = $_POST['menu_materials_teachers_id'];
                if (!empty($_FILES['url_material']['name'])) {
                    $directory = 'media/files/materials_teachers';
                    
                    //Видалення зображення з папки
                    unlink('./media/files/materials_teachers/'.$file_del);
                    
                    Upload::save($_FILES['url_material'], $_FILES['url_material']['name'], $directory, 0777);
                }
                else {
                    $materials_teachers->url_material = $file_del;
                }
                
                $materials_teachers->save();
                $ses_ok = Kohana::message('message', 'edit');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                $this->request->redirect('admin/materialsteachers');
            }
        }
        
        $content = View::factory('admin/materials_teachers/materials_teachers_edit_view')
            ->bind('id', $id)
            ->bind('errors', $errors)
            ->bind('errors_cap', $errors_cap)
            ->bind('data', $data)
            ->bind('menu_materials_teachers_ad', $menu_materials_teachers_ad)
            ->bind('menu_pid_all',$menu_pid_all);
        
        // Вивід в шаблон
        $this->template->page_title .= ' :: Редагування';
        $this->template->title .= ' :: Редагування';
        $this->template->block_main_content = array($content);
    }
    
    public function action_delete() {
        
        $id = (int) $this->request->param('id');
        $materials_teachers = ORM::factory('materialsteachers', $id);
        
        if(!$materials_teachers->loaded()){
            $this->request->redirect('admin/materialsteachers');
        }
        
        // Видалення зображення з папки
        $file_del = $materials_teachers->url_material;
        unlink('./media/files/materials_teachers/'.$file_del);
        
        $materials_teachers->delete();
        
        $ses_ok = Kohana::message('message', 'delete');
        $this->session->set('message_admin', $ses_ok); //Записуємо сесію
        
        $this->request->redirect('admin/materialsteachers');
    }
}