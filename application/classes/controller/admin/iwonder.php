<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Iwonder extends Controller_Admin {

    public function before() {
        parent::before();

        // Вивід в шаблон
        $this->template->submenu = Widget::load('menumaterials');
        $this->template->page_title = 'Цікаво знати';
        $this->template->title = 'Цікаво знати';
    }

    public function action_index() {
        
        $count = ORM::factory('iwonder')->count_all();
        
        $pagination = Pagination::factory(array(
            'total_items' => $count,
            'items_per_page' => 20))
        
         ->route_params( array(
        'controller' => Request::current()->controller(),
        'action' => Request::current()->action(),
      ));
        
        $iwonder = ORM::factory('iwonder')
            ->order_by('id','desc')
            ->limit($pagination->items_per_page)
            ->offset($pagination->offset)
            ->find_all();

        $info_ok = $this->session->get('message_admin');
        
        $content = View::factory('admin/iwonder/iwonder_index_view', array(
            'iwonder' => $iwonder,
            'pagination' => $pagination,
            'info_ok' => $info_ok,
        ));
        
        $this->session->delete('message_admin');
        
        // Вивід в шаблон
        $this->template->block_main_content = array($content);
    }

    public function action_add() {

        if (isset($_POST['submit'])) {
            $data = Arr::extract($_POST, array('content', 'publish_id'));
            $iwonder = ORM::factory('iwonder');
            $iwonder->values($data);

            try {
                $iwonder->save();
                
                $ses_ok = Kohana::message('message', 'add');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                
                $this->request->redirect('admin/iwonder');
            }
            catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }
        
            $content = View::factory('admin/iwonder/iwonder_add_view')
                ->bind('errors', $errors)
                ->bind('data', $data);
        
        // Вивід в шаблон
        $this->template->page_title .= ' :: Додавання';
        $this->template->title .= ' :: Додавання';
        $this->template->block_main_content = array($content);
    }

    public function action_edit() {
        
        $id = (int) $this->request->param('id');
        $iwonder = ORM::factory('iwonder', $id);

        if(!$iwonder->loaded()){
            $this->request->redirect('admin/iwonder');
        }

        $data = $iwonder->as_array();

        // Редагування
        if (isset($_POST['submit'])) {
            $data = Arr::extract($_POST, array('content', 'publish_id'));
            $iwonder->values($data);

            try {
                $iwonder->save();
                
                $ses_ok = Kohana::message('message', 'edit');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                
                $this->request->redirect('admin/iwonder');
            }
            catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }

        $content = View::factory('admin/iwonder/iwonder_edit_view')
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
        $iwonder = ORM::factory('iwonder', $id);
        
        if(!$iwonder->loaded()){
            $this->request->redirect('admin/iwonder');
        }
        
        $iwonder->delete();
        
        $ses_ok = Kohana::message('message', 'delete');
        $this->session->set('message_admin', $ses_ok); //Записуємо сесію
        
        $this->request->redirect('admin/iwonder');
    }
}