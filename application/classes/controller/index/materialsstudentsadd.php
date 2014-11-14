<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Методичні матеріали студентам стаціонару
 */
class Controller_Index_Materialsstudentsadd extends Controller_Index {

    public function before() {
        parent::before();
        
        if (!$this->auth->logged_in('teacher')) {
            if ($this->auth->logged_in()) {
                throw new HTTP_Exception_404('Ви немаєте права на публікацію методичних матеріалів');
                return;
            }
            else {
                $this->request->redirect('login');
            }
            
        }
        
        $this->template->scripts[] = 'media/js/jquery-1.6.2.min.js';
        $this->template->scripts[] = 'media/js/jquery.MultiFile.pack.js';
        $this->template->scripts[] = 'media/js/upload_file.js';
        $this->template->scripts[] = 'media/js/select.js';
        $this->template->scripts[] = 'media/js/select_add.js';
        
        // Вивід в шаблон
        $this->template->page_title = 'Методичні матеріали студентам стаціонару';
        $this->template->title = 'Методичні матеріали студентам стаціонару';
    }
    
    public function action_index() {
        
        $auth = Auth::instance();
        $user = $auth->get_user();
        $user1 = $user->first_name.' '.UTF8::substr($user->second_name, 0, 1).'.'.UTF8::substr($user->third_name, 0, 1).'.';
        
        $count = ORM::factory('materialsstudents')->where('author','=',$user1)->count_all();
            
        $pagination = Pagination::factory(array(
            'total_items' => $count,
            'items_per_page' => 20))
            
            ->route_params( array(
                'controller' => Request::current()->controller(),
                'action' => Request::current()->action(),
            ));
        
        $materials_students = ORM::factory('materialsstudents')
            ->order_by('id','desc')
            ->where('author','=',$user1)
            ->limit($pagination->items_per_page)
            ->offset($pagination->offset)
            ->find_all();
        
        $info_ok = $this->session->get('message_admin');
        
        $content = View::factory('index/materials_students_add/materials_students_add_index_view', array (
            'materials_students' => $materials_students,
            'pagination' => $pagination,
            'info_ok' => $info_ok,
            
        ));
        
        $this->session->delete('message_admin');

        // Вивід в шаблон
        $this->template->block_content = array($content);
    }
    
    // Додати
    public function action_add() {
        
        $auth = Auth::instance();
        
        $user = $auth->get_user();
        $user1 = $user->first_name.' '.UTF8::substr($user->second_name, 0, 1).'.'.UTF8::substr($user->third_name, 0, 1).'.';
        
        // Отримання всіх головних пунктів
        $menu_materials_students_ad = ORM::factory('menumaterialsstudents')
            ->where('lvl','=', 2)
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();
        
        // Отримання всіх підпунктів меню
        $menu_pid_all = ORM::factory('menumaterialsstudents')
            ->where('lvl','=', 3)
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();
        
        if (isset($_POST['submit'])) {
        
            $data = Arr::extract($_POST, array('title', 'title_number', 'intro', 'author', 'url_material', 'date','menu_id', 'menu_materials_students_id', 'publish_id'));
            $materials_students = ORM::factory('materialsstudents');
            $materials_students->values($data);
            $validate = Validation::factory($_FILES);
                $validate->rule('url_material', 'Upload::valid');
                $validate->rule('url_material', 'Upload::type', array(':value', array('zip')));
                $validate->rule('url_material', 'Upload::size', array(':value', '2M'));
                $validate->rule('url_material', 'regex', array(':value', '/^[-\pL\pN_.]++$/uD'));
            
            if ($validate->check()) {
                $kkk = 1;
            }
            else {
                $errors_cap = $validate->errors('upload');
                $kkk = 0;
            }
            
            try {
                $jjj =1;
                $materials_students->url_material = $_FILES['url_material']['name'];
                $materials_students->check();
                
            }
            catch (ORM_Validation_Exception $e) {
                $jjj = 0;
                $errors = $e->errors('validation');
            }
            
            if (($jjj!= 0)and($kkk == 1)) { 
                $directory = 'media/files/materials_students';
                // Запис в БД
                $materials_students->menu_materials_students_id = $_POST['menu_materials_students_id'];
                $materials_students->save();
                Upload::save($_FILES['url_material'], $_FILES['url_material']['name'], $directory, 0777);
                
                $ses_ok = Kohana::message('message', 'add');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                    
                $this->request->redirect('materialsstudentsadd');
            }
        }

        $content = View::factory('index/materials_students_add/materials_students_add_add_view')
            ->bind('errors', $errors)
            ->bind('errors_cap', $errors_cap)
            ->bind('user1', $user1)
            ->bind('data', $data)
            ->bind('auth', $auth)
            ->bind('menu_materials_students_ad', $menu_materials_students_ad)
            ->bind('menu_pid_all',$menu_pid_all);
        
        // Вивід в шаблон
        $this->template->page_title .= ' :: Додати';
        $this->template->title .= ' :: Додати';
        $this->template->block_content = array($content);
    }
    
    // Редагувати
    public function action_edit() {
        
        $id = (int) $this->request->param('id');
        if(!$id) {
            $this->request->redirect('materialsstudentsadd');
        }
        
        // Отримання всіх головних пунктів
        $menu_materials_students_ad = ORM::factory('menumaterialsstudents')
            ->where('lvl','=', 2)
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();
        
        // Отримання всіх підпунктів меню
        $menu_pid_all = ORM::factory('menumaterialsstudents')
            ->where('lvl','=', 3)
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();
                                
        $materials_students = ORM::factory('materialsstudents', $id);
        $file_del = $materials_students->url_material;
        $data = $materials_students->as_array();
        
        $data['menu_id'] = $materials_students->menu->parent()->id;
        $data['menu_materials_students_id'] = $materials_students->menu->id;
        
        // Редагування
        if (isset($_POST['submit'])) {
        
            $data = Arr::extract($_POST, array('title','title_number', 'intro', 'author', 'date', 'url_material', 'menu_id', 'menu_materials_students_id', 'publish_id'));
            $data['url_material'] =  $materials_students->url_material;
            $materials_students->values($data);
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
                    $materials_students->url_material = $file_del;
                }
                else {
                    $materials_students->url_material = $_FILES['url_material']['name'];
                }
                
                $materials_students->check();
            }
            catch (ORM_Validation_Exception $e) {
                $jjj = 0;
                $errors = $e->errors('validation');
            }
            
            if (($jjj!= 0)and($kkk == 1)) {
                
                // Запис в БД
                $materials_students->menu_materials_students_id = $_POST['menu_materials_students_id'];
                if (!empty($_FILES['url_material']['name'])) {
                    $directory = 'media/files/materials_students';
                    
                    //Видалення зображення з папки
                    unlink('./media/files/materials_students/'.$file_del);
                    
                    Upload::save($_FILES['url_material'], $_FILES['url_material']['name'], $directory, 0777);
                }
                else {
                    $materials_students->url_material = $file_del;
                }
                
                $materials_students->save();
                $ses_ok = Kohana::message('message', 'edit');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                $this->request->redirect('materialsstudentsadd');
            }
        }
        
        $content = View::factory('index/materials_students_add/materials_students_add_edit_view')
            ->bind('id', $id)
            ->bind('errors', $errors)
            ->bind('errors_cap', $errors_cap)
            ->bind('data', $data)
            ->bind('menu_materials_students_ad', $menu_materials_students_ad)
            ->bind('menu_pid_all',$menu_pid_all);
        
        // Вивід в шаблон
        $this->template->page_title .= ' :: Редагування';
        $this->template->title .= ' :: Редагування';
        $this->template->block_content = array($content);
    }
    
    //Видалення
    public function action_delete() {
        
        $id = (int) $this->request->param('id');
        $materials_students = ORM::factory('materialsstudents', $id);
        
        if(!$materials_students->loaded()){
            $this->request->redirect('materialsstudentsadd');
        }
        
        // Видалення зображення з папки
        $file_del = $materials_students->url_material;
        unlink('./media/files/materials_students/'.$file_del);
        
        $materials_students->delete();
        
        $ses_ok = Kohana::message('message', 'delete');
        $this->session->set('message_admin', $ses_ok); //Записуємо сесію
        
        $this->request->redirect('materialsstudentsadd');
    }
}