<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Меню для методичних матеріалів студентам заочникам
 */
class Controller_Admin_Menumaterialsstudentszaoch extends Controller_Admin {

    public function before() {
        parent::before();

        $this->template->scripts[] = 'media/js/jquery-1.6.2.min.js';
        $this->template->scripts[] = 'media/js/jquery.MultiFile.pack.js';
        $this->template->scripts[] = 'media/js/upload.js';
        $this->template->scripts[] = 'media/js/select.js';
        $this->template->scripts[] = 'media/js/select_add.js';
            
        //Вивід в шаблон
        $this->template->submenu = Widget::load('menumenu');
        $this->template->page_title = 'Меню для методичних матеріалів студентам заочникам';
        $this->template->title = 'Меню для методичних матеріалів студентам заочникам';
    }
    
    public function action_index() {
    
        $menu_materials_students = ORM::factory('menumaterialsstudentszaoch')->fulltree();
        
        $info_ok = $this->session->get('message_admin');
        
        $content = View::factory('admin/menu_materials_students_zaoch/menu_materials_students_index_view', array(
            'menu_materials_students' => $menu_materials_students,
            'info_ok' => $info_ok,
        ));
        
        $this->session->delete('message_admin');
        
        //Вивід в шаблон
        $this->template->block_main_content = array($content);
    }
    
    //Додати головний пункт меню
    public function action_add_main() {
        
        if (isset($_POST['submit'])) {
        
            $data = Arr::extract($_POST, array('title', 'small_img_url'));
            $menu_materials_students = ORM::factory('menumaterialsstudentszaoch');
            $menu_materials_students->values($data);
            
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
                $menu_materials_students->small_img_url = $_FILES['small_img_url']['name'];
                $menu_materials_students->check();
                
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
                $menu_materials_students->small_img_url = $filename;
                $menu_materials_students ->make_root();
                
                $ses_ok = Kohana::message('message', 'add');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                    
                $this->request->redirect('admin/menumaterialsstudentszaoch');
            }
        }
        
        $content = View::factory('admin/menu_materials_students_zaoch/menu_materials_students_add_main_view')
                ->bind('errors', $errors)
                 ->bind('errors_cap', $errors_cap)
                ->bind('data', $data);

        // Вивід в шаблон
        $this->template->page_title .= ' :: Додати';
        $this->template->title .= ' :: Додати';
        $this->template->block_main_content = array($content);
    }
    
    // Додавання підпункту предмет
    public function action_add_subject() {
    
        //Отримання всіх головних пунктів
        $menu_materials_students_all = ORM::factory('menumaterialsstudentszaoch')
            ->where('lvl','=', 1)
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();
        
        $menu_materials_students_ad = array();
        foreach ($menu_materials_students_all as $menu) {
            $menu_materials_students_ad[$menu->id] = $menu->title;
        }
        
        //Отримання всіх підпунктів
        $menu_pid_all = ORM::factory('menumaterialsstudentszaoch')
            ->where('lvl','=', 2)
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();
        
        if (isset($_POST['submit'])) {
            
            $data = Arr::extract($_POST, array('title', 'menu_id', 'pid_id'));
            $menu_materials_students = ORM::factory('menumaterialsstudentszaoch');
            $menu_materials_students->values($data);
            $menu_materials_students->small_img_url = 'no_image';
            
            try {
                switch ($_POST['way_id']) {
                    case 1:
                        $menu_materials_students ->insert_as_last_child($_POST['menu_id']);
                    break;
                        
                    case 2:
                        $menu_materials_students ->insert_as_first_child($_POST['menu_id']);
                    break;
                        
                    case 3:
                        if (isset($_POST['menu_pid'])) {
                            $menu_materials_students ->insert_as_next_sibling($_POST['menu_pid']);
                        }
                        else {
                            $menu_materials_students ->insert_as_last_child($_POST['menu_id']);
                        }
                    break;
                }
                
                $ses_ok = Kohana::message('message', 'add');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                    
                $this->request->redirect('admin/menumaterialsstudentszaoch');
            }
            catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }

        $content = View::factory('admin/menu_materials_students_zaoch/menu_materials_students_add_subject_view')
            ->bind('errors', $errors)
            ->bind('data', $data)
            ->bind('menu_materials_students_ad', $menu_materials_students_ad)
            ->bind('menu_pid_all', $menu_pid_all);
        
        // Вивід в шаблон
        $this->template->page_title .= ' :: Додати';
        $this->template->title .= ' :: Додати';
        $this->template->block_main_content = array($content);
    }
    
    //Додавання підпункту матеріал
    public function action_add_material() {
    
        //Отримання всіх підпунктів предмет
        $menu_materials_students_ad = ORM::factory('menumaterialsstudentszaoch')
            ->where('lvl','=', 2)
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();
        
        //Отримання всіх підпунктів матеріалів
        $menu_pid_all = ORM::factory('menumaterialsstudentszaoch')
            ->where('lvl','=', 3)
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();
        
        if (isset($_POST['submit'])) {
        
            $data = Arr::extract($_POST, array('title', 'small_img_url','menu_id', 'pid_id'));
            $menu_materials_students = ORM::factory('menumaterialsstudentszaoch');
            $menu_materials_students->values($data);
            
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
                $menu_materials_students->small_img_url = $_FILES['small_img_url']['name'];
                $menu_materials_students->check();
                
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
                $menu_materials_students->small_img_url = $filename;
                switch ($_POST['way_id']) {
                    case 1:
                        $menu_materials_students ->insert_as_last_child($_POST['menu_id']);
                    break;
                            
                    case 2:
                        $menu_materials_students ->insert_as_first_child($_POST['menu_id']);
                    break;
                                
                    case 3:
                        if (isset($_POST['menu_pid'])) {
                            $menu_materials_students ->insert_as_next_sibling($_POST['menu_pid']);
                        }
                        else {
                            $menu_materials_students ->insert_as_last_child($_POST['menu_id']);
                        }
                    break;
                }
                
                $ses_ok = Kohana::message('message', 'add');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                    
                $this->request->redirect('admin/menumaterialsstudentszaoch');
            }
        }

        $content = View::factory('admin/menu_materials_students_zaoch/menu_materials_students_add_material_view')
            ->bind('errors', $errors)
            ->bind('errors_cap', $errors_cap)
            ->bind('data', $data)
            ->bind('menu_materials_students_ad', $menu_materials_students_ad)
            ->bind('menu_pid_all', $menu_pid_all);
        
        // Вивід в шаблон
        $this->template->page_title .= ' :: Додати';
        $this->template->title .= ' :: Додати';
        $this->template->block_main_content = array($content);
    }
    
    //Редагування
    public function action_edit() {
        
        $id = (int) $this->request->param('id');
        if(!$id) {
            $this->request->redirect('admin/menumaterialsstudentszaoch');
        }
        $menu_materials_students = ORM::factory('menumaterialsstudentszaoch', $id);
        $data = $menu_materials_students->as_array();
        
        // Редагування
        if (isset($_POST['submit'])) {
            $data = Arr::extract($_POST, array('title','menu_id'));
            $menu_materials_students->values($data);
            try {
                $menu_materials_students->save();
                
                $ses_ok = Kohana::message('message', 'edit');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                
                $this->request->redirect('admin/menumaterialsstudentszaoch');
            }
            catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }
        
        $men = ORM::factory('menumaterialsstudentszaoch')->where('id','=',$id)->find();
        $men_got = $menu_materials_students->where('id','=', $men->parent_id)->as_array();
        $data['menu_id'] = $men_got['parent_id'];
                
        //Отримання всіх головних пунктів
        $menu_materials_students_all = ORM::factory('menumaterialsstudentszaoch')
            ->where('id','=', $data['menu_id'])
            ->find_all()
            ->as_array();

        $menu_materials_students_ad = array();
        foreach ($menu_materials_students_all as $menu) {
            $menu_materials_students_ad[$menu->id] = $menu->title;
        }
        
        switch($menu_materials_students->lvl) {
            
            case 1:
                $link_edit = 'admin/menu_materials_students_zaoch/menu_materials_students_edit_main_view';
            break;
            
            case 2:
                $link_edit = 'admin/menu_materials_students_zaoch/menu_materials_students_edit_subject_view';
            break;
            
            case 3:
                $link_edit = 'admin/menu_materials_students_zaoch/menu_materials_students_edit_material_view';
            break;
        }
        
        $content = View::factory($link_edit)
            ->bind('id', $id)
            ->bind('errors', $errors)
            ->bind('menu_materials_students_ad',$menu_materials_students_ad)
            ->bind('data', $data);
        
        // Вивід в шаблон
        $this->template->page_title .= ' :: Редагування';
        $this->template->title .= ' :: Редагування';
        $this->template->block_main_content = array($content);
    }
    
    public function action_delete() {
        $id = (int) $this->request->param('id');
        $menu_materials_students = ORM::factory('menumaterialsstudentszaoch', $id);
        
        if(!$menu_materials_students->loaded()){
            $this->request->redirect('admin/menumaterialsstudentszaoch');
        }
        
        switch ($menu_materials_students->level()) {
            case '1':
                //Видалення зображення з папки
                $img_del_small = $menu_materials_students->small_img_url;
                unlink('./media/img/small_img_material/'.$img_del_small);
                if ($menu_materials_students->has_children()) {
                    $scope_main = $menu_materials_students->scope();
                    $del_potom = ORM::factory('menumaterialsstudentszaoch')->where('scope','=',$scope_main)->where('lvl','=',3)->find_all();
                    foreach ($del_potom as $del_p) {
                        if ($del_p->id != null) {
                            //Видалення зображення з папки
                            unlink('./media/img/small_img_material/'.$del_p->small_img_url);
                        }
                    }
                }
                
            break;
                
            case '2':
                $del_potom = ORM::factory('menumaterialsstudentszaoch')->where('parent_id','=',$id)->find_all();
                foreach ($del_potom as $del_p) {
                    if ($del_p->id != null) {
                        //Видалення зображення з папки
                        unlink('./media/img/small_img_material/'.$del_p->small_img_url);
                    }
                }
            break;
                
            case '3':
                //Видалення зображення з папки
                $img_del_small = $menu_materials_students->small_img_url;
                unlink('./media/img/small_img_material/'.$img_del_small);
            break;
        }
        
        $menu_materials_students->delete();
        
        $ses_ok = Kohana::message('message', 'delete');
        $this->session->set('message_admin', $ses_ok); //Записуємо сесію
        
        $this->request->redirect('admin/menumaterialsstudentszaoch');
    }
}