<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Меню для методичних матеріалів викладачу
 */
class Controller_Admin_Menumaterialsteachers extends Controller_Admin {

    public function before() {
        parent::before();

        $this->template->scripts[] = 'media/js/jquery-1.6.2.min.js';
        $this->template->scripts[] = 'media/js/jquery.MultiFile.pack.js';
        $this->template->scripts[] = 'media/js/upload.js';
        $this->template->scripts[] = 'media/js/select.js';
        $this->template->scripts[] = 'media/js/select_add.js';
            
        //Вивід в шаблон
        $this->template->submenu = Widget::load('menumenu');
        $this->template->page_title = 'Меню для методичних матеріалів викладачу';
        $this->template->title = 'Меню для методичних матеріалів викладачу';
    }
    
    public function action_index() {
    
        $menu_materials_teachers = ORM::factory('menumaterialsteachers')->fulltree();
        
        $info_ok = $this->session->get('message_admin');
        
        $content = View::factory('admin/menu_materials_teachers/menu_materials_teachers_index_view', array (
            'menu_materials_teachers' => $menu_materials_teachers,
            'info_ok' => $info_ok,
        ));
        
        $this->session->delete('message_admin');

        //Вивід в шаблон
        $this->template->block_main_content = array($content);
    }
    
    // Додати головний пункт меню
    public function action_add_main() {
        
        if (isset($_POST['submit'])) {
        $data = Arr::extract($_POST, array('title', 'small_img_url'));
        $menu_materials_teachers = ORM::factory('menumaterialsteachers');
        $menu_materials_teachers->values($data);
        
        $validate = Validation::factory($_FILES);
                $validate->rule('small_img_url', 'Upload::valid');
                $validate->rule('small_img_url', 'Upload::type', array(':value', array('jpg', 'gif', 'bmp', 'png')));
                $validate->rule('small_img_url', 'Upload::size', array(':value', '1M'));
            
            if ($validate->check()) {
                $kkk = 1;
            }
            else {
                $errors_cap = $validate->errors('upload');
                $kkk = 0;
            }
            
            try {
                $jjj =1;
                $menu_materials_teachers->small_img_url = $_FILES['small_img_url']['name'];
                $menu_materials_teachers->check();
                
            }
            catch (ORM_Validation_Exception $e) {
                $jjj = 0;
                $errors = $e->errors('validation');
            }
            
            if (($jjj!= 0)and($kkk == 1)) {
                
                $useful = new Model_Useful();
                
                //Задання імені файлу
                $filename = $useful->_name_img();
                
                //Редагування файлу і завантаження в папку
                $image = $_FILES['small_img_url']['tmp_name'];
                $width = $height = 45;
                $useful->_edit_upload_img($image, $filename, $width, $height);
                
                //Запис в БД
                $menu_materials_teachers->small_img_url = $filename;
                $menu_materials_teachers ->make_root();
                
                $ses_ok = Kohana::message('message', 'add');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                    
                $this->request->redirect('admin/menumaterialsteachers');
            }
        }

        $content = View::factory('admin/menu_materials_teachers/menu_materials_teachers_add_main_view')
            ->bind('errors', $errors)
            ->bind('errors_cap', $errors_cap)
            ->bind('data', $data);

        // Вивід в шаблон
        $this->template->page_title .= ' :: Додати';
        $this->template->title .= ' :: Додати';
        $this->template->block_main_content = array($content);
    }
    
    //Додати підпункт головного пункту меню
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
        
        //Отримання всіх підпунктів
        $menu_pid_all = ORM::factory('menumaterialsteachers')
            ->where('lvl','=', 2)
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();
        
        if (isset($_POST['submit'])) {
        
            $data = Arr::extract($_POST, array('title', 'small_img_url', 'menu_id', 'pid_id'));
            $menu_materials_teachers = ORM::factory('menumaterialsteachers');
            $menu_materials_teachers->values($data);
            
            $validate = Validation::factory($_FILES);
                $validate->rule('small_img_url', 'Upload::valid');
                $validate->rule('small_img_url', 'Upload::type', array(':value', array('jpg', 'gif', 'bmp', 'png')));
                $validate->rule('small_img_url', 'Upload::size', array(':value', '1M'));
            
            if ($validate->check()) {
                $kkk = 1;
            }
            else {
                $errors_cap = $validate->errors('upload');
                $kkk = 0;
            }
            
            try {
                $jjj =1;
                $menu_materials_teachers->small_img_url = $_FILES['small_img_url']['name'];
                $menu_materials_teachers->check();
                
            }
            catch (ORM_Validation_Exception $e) {
                $jjj = 0;
                $errors = $e->errors('validation');
            }
            
            if (($jjj!= 0)and($kkk == 1)) {
                
                $useful = new Model_Useful();
                
                //Задання імені файлу
                $filename = $useful->_name_img();
                
                //Редагування файлу і завантаження в папку
                $image = $_FILES['small_img_url']['tmp_name'];
                $width = $height = 45;
                $useful->_edit_upload_img($image, $filename, $width, $height);
                
                //Запис в БД
                $menu_materials_teachers->small_img_url = $filename;
                switch ($_POST['way_id']) {
                    case 1:
                        $menu_materials_teachers ->insert_as_last_child($_POST['menu_id']);
                    break;
                            
                    case 2:
                        $menu_materials_teachers ->insert_as_first_child($_POST['menu_id']);
                    break;
                                
                    case 3:
                        if (isset($_POST['menu_pid'])) {
                            $menu_materials_teachers ->insert_as_next_sibling($_POST['menu_pid']);
                        }
                        else {
                            $menu_materials_teachers ->insert_as_last_child($_POST['menu_id']);
                        }
                    break;
                }
                
                $ses_ok = Kohana::message('message', 'add');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                    
                $this->request->redirect('admin/menumaterialsteachers');
            }
        }

        $content = View::factory('admin/menu_materials_teachers/menu_materials_teachers_add_view')
            ->bind('errors', $errors)
            ->bind('errors_cap', $errors_cap)
            ->bind('data', $data)
            ->bind('menu_materials_teachers_ad', $menu_materials_teachers_ad)
            ->bind('menu_pid_all', $menu_pid_all);
        
        //Вивід в шаблон
        $this->template->page_title .= ' :: Додати';
        $this->template->title .= ' :: Додати';
        $this->template->block_main_content = array($content);
    }
    
    public function action_edit() {
        
        $id = (int) $this->request->param('id');
        if(!$id) {
            $this->request->redirect('admin/menumaterialsteachers');
        }
        $menu_materials_teachers = ORM::factory('menumaterialsteachers', $id);
        $data = $menu_materials_teachers->as_array();
            
        // Редагування
        if (isset($_POST['submit'])) {
            
            $data = Arr::extract($_POST, array('title'));
            $menu_materials_teachers->values($data);
    
            try {
                $menu_materials_teachers->save();
                
                $ses_ok = Kohana::message('message', 'edit');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                
                $this->request->redirect('admin/menumaterialsteachers');
            }
            catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }
    
        $content = View::factory('admin/menu_materials_teachers/menu_materials_teachers_edit_main_view')
            ->bind('id', $id)
            ->bind('errors', $errors)
            ->bind('data', $data);
        
        // Вивід в шаблон
        $this->template->page_title .= ' :: Редагування';
        $this->template->title .= ' :: Редагування';
        $this->template->block_main_content = array($content);
    }
    
    public function action_delete() {
        
        $id = (int) $this->request->param('id');
        $menu_materials_teachers = ORM::factory('menumaterialsteachers', $id);
        
        if(!$menu_materials_teachers->loaded()){
            $this->request->redirect('admin/menumaterialsteachers');
        }
        
        switch ($menu_materials_teachers->level()) {
            case '1':
                 //Видалення зображення з папки
                $img_del_small = $menu_materials_teachers->small_img_url;
                unlink('./media/img/small_img_material/'.$img_del_small);
                if ($menu_materials_teachers->has_children()) {
                    $scope_main = $menu_materials_teachers->scope();
                    $del_potom = ORM::factory('menumaterialsteachers')->where('scope','=',$scope_main)->where('lvl','=',2)->find_all();
                    foreach ($del_potom as $del_p) {
                        if ($del_p->id != null) {
                            //Видалення зображення з папки
                            unlink('./media/img/small_img_material/'.$del_p->small_img_url);
                        }
                    }
                }
            break;
                
            case '2':
                //Видалення зображення з папки
                $img_del_small = $menu_materials_teachers->small_img_url;
                unlink('./media/img/small_img_material/'.$img_del_small);
            break;
        }
        
        $menu_materials_teachers->delete();
        
        $ses_ok = Kohana::message('message', 'delete');
        $this->session->set('message_admin', $ses_ok); //Записуємо сесію
        
        $this->request->redirect('admin/menumaterialsteachers');
    }
}