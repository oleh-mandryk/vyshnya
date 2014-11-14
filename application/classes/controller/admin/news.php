<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Новини
 */
class Controller_Admin_News extends Controller_Admin {

    public function before() {
        parent::before();
        
        $this->template->scripts[] = 'media/js/jquery-1.6.2.min.js';
        $this->template->scripts[] = 'media/js/jquery.MultiFile.pack.js';
        $this->template->scripts[] = 'media/js/upload.js';
        
        // Вывод в шаблон
        $this->template->submenu = Widget::load('menumaterials');
        $this->template->page_title = 'Новини';
        $this->template->title = 'Новини';
    }

    public function action_index() {
        $count = ORM::factory('new')->count_all();
        
        $pagination = Pagination::factory(array(
            'total_items' => $count,
            'items_per_page' => 20))
            ->route_params( array(
                'controller' => Request::current()->controller(),
                'action' => Request::current()->action(),
            ));
        $news = ORM::factory('new')
            ->order_by('id','desc')
            ->limit($pagination->items_per_page)
            ->offset($pagination->offset)
            ->find_all();
        
        $info_ok = $this->session->get('message_admin');
        
        $content = View::factory('admin/news/news_index_view', array(
            'news' => $news,
            'pagination' => $pagination,
            'info_ok' => $info_ok,
        ));
        
        $this->session->delete('message_admin');

        // Вывод в шаблон
        $this->template->block_main_content = array($content);
    }

    public function action_add() {

        if (isset($_POST['submit'])) {
            $data = Arr::extract($_POST, array('description','keywords', 'title', 'intro', 'content', 'small_img_url', 'date', 'publish_id'));
            $news = ORM::factory('new');
            $news->values($data);
            
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
                $news->small_img_url = $_FILES['small_img_url']['name'];
                $news->check();
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
                $news->small_img_url = $filename;
                $news->save();
                
                $ses_ok = Kohana::message('message', 'add');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                    
                $this->request->redirect('admin/news');
            }
        }

        $content = View::factory('admin/news/news_add_view')
                ->bind('errors', $errors)
                ->bind('errors_cap', $errors_cap)
                ->bind('data', $data);

        // Вивід в шаблон
        $this->template->page_title .= ' :: Додати';
        $this->template->title .= ' :: Додати';
        $this->template->block_main_content = array($content);
    }

    public function action_edit() {
        $id = (int) $this->request->param('id');
        $pages = ORM::factory('new', $id);

        if(!$pages->loaded()){
            $this->request->redirect('admin/pages');
        }

        $data = $pages->as_array();

        // Редагування
        if (isset($_POST['submit'])) {
            $data = Arr::extract($_POST, array('description','keywords', 'title', 'intro', 'content', 'date', 'publish_id'));
            $pages->values($data);
            
            try {
                $pages->save();
                
                $ses_ok = Kohana::message('message', 'edit');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                
                $this->request->redirect('admin/news');
            }
            catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }

        $content = View::factory('admin/news/news_edit_view')
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
        $news = ORM::factory('new', $id);
        
        if(!$news->loaded()){
            $this->request->redirect('admin/news');
        }
        //Видалення зображення з папки
        $img_del_small = $news->small_img_url;
        unlink('./media/img/small_img_material/'.$img_del_small);
        
        $news->delete();
        
        $ses_ok = Kohana::message('message', 'delete');
        $this->session->set('message_admin', $ses_ok); //Записуємо сесію

        $this->request->redirect('admin/news');
    }
}