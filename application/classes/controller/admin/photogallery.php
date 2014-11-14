<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Фотографії фотогалереї
 */
class Controller_Admin_Photogallery extends Controller_Admin {

    public function before() {
        parent::before();
        
        $this->template->scripts[] = 'media/js/jquery-1.6.2.min.js';
        $this->template->scripts[] = 'media/js/jquery.MultiFile.pack.js';
        $this->template->scripts[] = 'media/js/upload.js';
        
        // Вывод в шаблон
        $this->template->submenu = Widget::load('menuphoto');
        $this->template->page_title = 'Фотографії фотогалереї';
        $this->template->title = 'Фотографії фотогалереї';
    }

    public function action_index() {
        $count = ORM::factory('photogallery')->count_all();
        
        $pagination = Pagination::factory(array(
            'total_items' => $count,
            'items_per_page' => 20))
            ->route_params( array(
                'controller' => Request::current()->controller(),
                'action' => Request::current()->action(),
            ));
        $photogallery = ORM::factory('photogallery')
            ->order_by('id','desc')
            ->limit($pagination->items_per_page)
            ->offset($pagination->offset)
            ->find_all();

        $info_ok = $this->session->get('message_admin');
        
        $content = View::factory('admin/photogallery/photogallery_index_view', array(
            'photogallery' => $photogallery,
            'pagination' => $pagination,
            'info_ok' => $info_ok,
        ));
        
        $this->session->delete('message_admin');

        // Вывод в шаблон
        $this->template->block_main_content = array($content);
    }

    public function action_add() {

        //Отримання всіх категорій
        $menu_photogallery_all = ORM::factory('menuphotogallery')
            ->where('publish_id','=',1)
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();
        
        $menu_photogallery_ad = array();
        foreach ($menu_photogallery_all as $menu) {
            $menu_photogallery_ad[$menu->id] = $menu->title;
        }
        
        if (isset($_POST['submit'])) {
            $data = Arr::extract($_POST, array('title', 'date', 'section_id', 'url_img', 'publish_id'));
            $photogallery = ORM::factory('photogallery');
            $photogallery->values($data);
                
            $validate = Validation::factory($_FILES);
                $validate->rule('url_img', 'Upload::valid');
                $validate->rule('url_img', 'Upload::type', array(':value', array('jpg', 'gif', 'bmp', 'png')));
                $validate->rule('url_img', 'Upload::size', array(':value', '1M'));
            
            if ($validate->check()) {
                $kkk = 1;
            }
            else {
                $errors_cap = $validate->errors('upload');
                $kkk = 0;
            }
            
            try {
                $jjj =1;
                $photogallery->url_img = $_FILES['url_img']['name'];
                $photogallery->check();
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
                $image = $_FILES['url_img']['tmp_name'];
                $useful->_edit_upload_foto($image, $filename);
                
                //Запис в БД
                $photogallery->url_img = $filename;
                $photogallery->section_id = $_POST['section_id'];
                $photogallery->save();
                
                $ses_ok = Kohana::message('message', 'add');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                    
                $this->request->redirect('admin/photogallery');
            }    
        }

        $content = View::factory('admin/photogallery/photogallery_add_view')
                ->bind('errors', $errors)
                ->bind('errors_cap', $errors_cap)
                ->bind('data', $data)
                ->bind('menu_photogallery_ad',$menu_photogallery_ad);

        // Вивід в шаблон
        $this->template->page_title .= ' :: Додати';
        $this->template->title .= ' :: Додати';
        $this->template->block_main_content = array($content);
    }

    public function action_edit() {
        
        $id = (int) $this->request->param('id');
        $photogallery = ORM::factory('photogallery', $id);

        //Отримання всіх категорій
        $menu_photogallery_all = ORM::factory('menuphotogallery')
            ->where('publish_id','=',1)
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();
        
        $menu_photogallery_ad = array();
        foreach ($menu_photogallery_all as $menu) {
            $menu_photogallery_ad[$menu->id] = $menu->title;
        }
        
        if(!$photogallery->loaded()){
            $this->request->redirect('admin/photogallery');
        }

        $data = $photogallery->as_array();

        // Редагування
        if (isset($_POST['submit'])) {
            $data = Arr::extract($_POST, array('title', 'date', 'section_id', 'publish_id'));
            $photogallery->values($data);
            
            try {
                $photogallery->save();
                
                $ses_ok = Kohana::message('message', 'edit');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                
                $this->request->redirect('admin/photogallery');
            }
            catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }

        $content = View::factory('admin/photogallery/photogallery_edit_view')
                ->bind('id', $id)
                ->bind('errors', $errors)
                ->bind('data', $data)
                ->bind('menu_photogallery_ad',$menu_photogallery_ad);

        // Вивід в шаблон
        $this->template->page_title .= ' :: Редагування';
        $this->template->title .= ' :: Редагування';
        $this->template->block_main_content = array($content);
    }

    public function action_delete() {
        $id = (int) $this->request->param('id');
        $photogallery = ORM::factory('photogallery', $id);
        
        if(!$photogallery->loaded()){
            $this->request->redirect('admin/photogallery');
        }
        //Видалення зображення з папки
        $img_del_small = $photogallery->url_img;
        unlink('./media/img/photogallery/small/'.$img_del_small);
        
        $img_del_big = $photogallery->url_img;
        unlink('./media/img/photogallery/big/'.$img_del_big);
        
        $photogallery->delete();
        
        $ses_ok = Kohana::message('message', 'delete');
        $this->session->set('message_admin', $ses_ok); //Записуємо сесію
        
        $this->request->redirect('admin/photogallery');
    }
    
    

}