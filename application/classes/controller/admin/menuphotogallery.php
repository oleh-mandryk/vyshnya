<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Категорії фотогалереї
 */
class Controller_Admin_Menuphotogallery extends Controller_Admin {

    public function before() {
        parent::before();

        //Вивід в шаблон
        $this->template->submenu = Widget::load('menuphoto');
        $this->template->page_title = 'Категорії фотогалереї';
        $this->template->title = 'Категорії фотогалереї';
    }

    public function action_index() {
        
        $count = ORM::factory('menuphotogallery')->count_all();
        
        $pagination = Pagination::factory(array(
            'total_items' => $count,
            'items_per_page' => 20))
        
         ->route_params( array(
        'controller' => Request::current()->controller(),
        'action' => Request::current()->action(),
      ));
        
        $menuphotogallery = ORM::factory('menuphotogallery')
            ->order_by('id','desc')
            ->limit($pagination->items_per_page)
            ->offset($pagination->offset)
            ->find_all();
        
        $info_ok = $this->session->get('message_admin');
        
        $content = View::factory('admin/menu_photogallery/menu_photogallery_index_view', array(
            'menuphotogallery' => $menuphotogallery,
            'pagination' => $pagination,
            'info_ok' => $info_ok,
        ));
        
        $this->session->delete('message_admin');

        //Вивід в шаблон
        $this->template->block_main_content = array($content);
    }

    public function action_add() {

        if (isset($_POST['submit'])) {
            $data = Arr::extract($_POST, array('alias', 'title', 'intro', 'publish_id'));
            $menuphotogallery = ORM::factory('menuphotogallery');
            $menuphotogallery->values($data);

            try {
                $menuphotogallery->save();
                
                $ses_ok = Kohana::message('message', 'add');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                
                $this->request->redirect('admin/menuphotogallery');
            }
            catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }

        $content = View::factory('admin/menu_photogallery/menu_photogallery_add_view')
                ->bind('errors', $errors)
                ->bind('data', $data);

        // Вивід в шаблон
        $this->template->page_title .= ' :: Додавання';
        $this->template->title .= ' :: Додавання';
        $this->template->block_main_content = array($content);
    }

    public function action_edit() {
        
        $id = (int) $this->request->param('id');
        $menuphotogallery = ORM::factory('menuphotogallery', $id);

        if(!$menuphotogallery->loaded()){
            $this->request->redirect('admin/menuphotogallery');
        }

        $data = $menuphotogallery->as_array();

        // Редагування
        if (isset($_POST['submit'])) {
            $data = Arr::extract($_POST, array('alias', 'title', 'intro', 'publish_id'));
            $menuphotogallery->values($data);

            try {
                $menuphotogallery->save();
                
                $ses_ok = Kohana::message('message', 'edit');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                
                $this->request->redirect('admin/menuphotogallery');
            }
            catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }

        $content = View::factory('admin/menu_photogallery/menu_photogallery_edit_view')
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
        $menuphotogallery = ORM::factory('menuphotogallery', $id);
        
        if(!$menuphotogallery->loaded()){
            $this->request->redirect('admin/menuphotogallery');
        }

        $menuphotogallery->delete();
        
        $ses_ok = Kohana::message('message', 'delete');
        $this->session->set('message_admin', $ses_ok); //Записуємо сесію
        
        $this->request->redirect('admin/menuphotogallery');
    }
}