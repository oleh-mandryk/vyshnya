<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Презентація
 */
class Controller_Admin_Presentation extends Controller_Admin {

    public function before() {
        parent::before();
        
        $this->template->scripts[] = 'media/js/jquery-1.6.2.min.js';
        $this->template->scripts[] = 'media/js/jquery.MultiFile.pack.js';
        $this->template->scripts[] = 'media/js/upload.js';
        
        // Вивід в шаблон
        $this->template->submenu = Widget::load('menumaterials');
        $this->template->page_title = 'Презентація';
        $this->template->title = 'Презентація';
    }

    public function action_index() {
        
        $count = ORM::factory('presentation')->count_all();
        
        $pagination = Pagination::factory(array(
            'total_items' => $count,
            'items_per_page' => 20))
            
        ->route_params( array(
        'controller' => Request::current()->controller(),
        'action' => Request::current()->action(),
      ));
        
        $slides = ORM::factory('presentation')
            ->order_by('id','desc')
            ->limit($pagination->items_per_page)
            ->offset($pagination->offset)
            ->find_all();

        $info_ok = $this->session->get('message_admin');
        
        $content = View::factory('admin/presentation/presentation_index_view', array(
            'slides' => $slides,
            'pagination' => $pagination,
            'info_ok' => $info_ok,
        ));
        
        $this->session->delete('message_admin');

        // Вивід в шаблон
        $this->template->block_main_content = array($content);
    }

    public function action_add() {

        //Отримання всіх сторінок
        $pages_all = ORM::factory('page')
            ->where('alias','!=', 'index')
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();
        
        $pages = array();
        foreach ($pages_all as $page){
            $pages[$page->id] = $page->title;
        }
                        
        if (isset($_POST['submit'])) {
            $data = Arr::extract($_POST, array('title', 'page_id', 'content', 'img_url', 'publish_id'));
            $slides = ORM::factory('presentation');
            $slides->values($data);
            
            $validate = Validation::factory($_FILES);
                $validate->rule('img_url', 'Upload::valid');
                $validate->rule('img_url', 'Upload::type', array(':value', array('jpg', 'gif', 'bmp', 'png')));
                $validate->rule('img_url', 'Upload::size', array(':value', '1M'));
            
            if ($validate->check()) {
                $kkk = 1;
            }
            else {
                $errors_cap = $validate->errors('upload');
                $kkk = 0;
            }
            
            try {
                $jjj =1;
                $slides->img_url = $_FILES['img_url']['name'];
                $slides->check();
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
                $image = $_FILES['img_url']['tmp_name'];
                $width = 333; $height = 250;
                $useful->_edit_upload_img($image, $filename, $width, $height, 'media/img/presentation');
                
                //Запис в БД
                $slides->img_url = $filename;
                $slides->save();
                
                $ses_ok = Kohana::message('message', 'add');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                    
                $this->request->redirect('admin/presentation');
            }
        }

        $content = View::factory('admin/presentation/presentation_add_view')
            ->bind('errors', $errors)
            ->bind('errors_cap', $errors_cap)
            ->bind('data', $data)
            ->bind('pages',$pages);

        // Вивід в шаблон
        $this->template->page_title .= ' :: Додати';
        $this->template->title .= ' :: Додати';
        $this->template->block_main_content = array($content);
    }

    public function action_edit() {
        
        $id = (int) $this->request->param('id');
        $slides = ORM::factory('presentation', $id);

        if(!$slides->loaded()){
            $this->request->redirect('admin/presentation');
        }
        
        //Отримання всіх сторінок
        $pages_all = ORM::factory('page')
            ->where('alias','!=', 'index')
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();
        
        $pages = array();
        foreach ($pages_all as $page){
            $pages[$page->id] = $page->title;
        }
        
        $img_del = $slides->img_url;
        $data = $slides->as_array();

        // Редагування
        if (isset($_POST['submit'])) {
            $data = Arr::extract($_POST, array('title', 'page_id', 'content', 'img_url','publish_id'));
            $data['img_url'] =  $slides->img_url;
            $slides->values($data);
            
            $validate = Validation::factory($_FILES);
                $validate->rule('img_url', 'Upload::valid');
                $validate->rule('img_url', 'Upload::type', array(':value', array('jpg', 'gif', 'bmp', 'png')));
                $validate->rule('img_url', 'Upload::size', array(':value', '1M'));
            
            if ($validate->check()) {
                $kkk = 1;
            }
            else {
                $errors_cap = $validate->errors('upload');
                $kkk = 0;
            }
            
            try {
                $jjj =1;
                if (empty($_FILES['img_url']['name']))
                {
                    $slides->img_url = $img_del;
                }
                else {
                    $slides->img_url = $_FILES['img_url']['name'];
                }
                
                $slides->check();
            }
            catch (ORM_Validation_Exception $e) {
                $jjj = 0;
                $errors = $e->errors('validation');
            }
            
            if (($jjj!= 0)and($kkk == 1)) {
                
                // Запис в БД
                if (!empty($_FILES['img_url']['name'])) {
                    
                    $useful = new Model_Useful();
                
                    //Задання імені файлу
                    $filename = $useful->_name_img();
                    
                    //Редагування файлу і завантаження в папку
                    $image = $_FILES['img_url']['tmp_name'];
                    $width = 333; $height = 250;
                    $useful->_edit_upload_img($image, $filename, $width, $height, 'media/img/presentation');
                    
                    //Запис в БД
                    echo $slides->img_url = $filename;                    
                    
                    //Видалення зображення з папки
                    unlink('./media/img/presentation/'.$img_del);
                }
                else {
                    $slides->img_url = $img_del;
                }
                
                $slides->save();
                $ses_ok = Kohana::message('message', 'edit');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                $this->request->redirect('admin/presentation');
            }
        }

        $content = View::factory('admin/presentation/presentation_edit_view')
                ->bind('id', $id)
                ->bind('errors', $errors)
                ->bind('errors_cap', $errors_cap)
                ->bind('data', $data)
                ->bind('pages',$pages);

        // Вивід в шаблон
        $this->template->page_title .= ' :: Редагування';
        $this->template->title .= ' :: Редагування';
        $this->template->block_main_content = array($content);
    }

    public function action_delete() {
        $id = (int) $this->request->param('id');
        $slides = ORM::factory('presentation', $id);
        
        if(!$slides->loaded()){
            $this->request->redirect('admin/presentation');
        }
        //Видалення зображення з папки
        $img_del = $slides->img_url;
        unlink('./media/img/presentation/'.$img_del);
        
        $slides->delete();
        
        $ses_ok = Kohana::message('message', 'delete');
        $this->session->set('message_admin', $ses_ok); //Записуємо сесію
        
        $this->request->redirect('admin/presentation');
    }
}