<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Відповіді для голосування
 */
class Controller_Admin_Polloptions extends Controller_Admin {

    public function before() {
        parent::before();

        // Вивід в шаблон
        $this->template->submenu = Widget::load('menupolls');
        $this->template->page_title = 'Відповіді для голосування';
        $this->template->title = 'Відповіді для голосування';
    }

    public function action_index() {
    
        $poll_options = ORM::factory('polloption')->find_all();
        
        $info_ok = $this->session->get('message_admin');
        
        $content = View::factory('admin/poll_options/poll_options_index_view', array(
            'poll_options' => $poll_options,
            'info_ok' => $info_ok,
        ));
        
        $this->session->delete('message_admin');

        //Вивід в шаблон
        $this->template->block_main_content = array($content);
    }

    public function action_add() {
        
            if (isset($_POST['submit'])) {
            $data = Arr::extract($_POST, array('value', 'publish_id'));
            $poll_options = ORM::factory('polloption');
            $menu_main1 = ORM::factory('menumain');
            $poll_options->values($data);

            try {
                $poll_options->save();
                
                $ses_ok = Kohana::message('message', 'add');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                
                $this->request->redirect('admin/polloptions');
            }
            catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }

        $content = View::factory('admin/poll_options/poll_options_add_view')
                ->bind('errors', $errors)
                ->bind('data', $data);

        // Вивід в шаблон
        $this->template->page_title .= ' :: Додати';
        $this->template->title .= ' :: Додати';
        $this->template->block_main_content = array($content);
    }
    
    
    public function action_edit() {
        
        $id = (int) $this->request->param('id');
        $poll_options = ORM::factory('polloption', $id);

        if(!$poll_options->loaded()){
            $this->request->redirect('admin/polloptions');
        }

        $data = $poll_options->as_array();

        // Редагування
        if (isset($_POST['submit'])) {
            $data = Arr::extract($_POST, array('value', 'publish_id'));
            $poll_options->values($data);

            try {
                $poll_options->save();
                
                $ses_ok = Kohana::message('message', 'edit');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                
                $this->request->redirect('admin/polloptions');
            }
            catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }

        $content = View::factory('admin/poll_options/poll_options_edit_view')
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
        $poll_options = ORM::factory('polloption', $id);
        
        if(!$poll_options->loaded()){
            $this->request->redirect('admin/polloptions');
        }

        $poll_options->delete();
        
        $ses_ok = Kohana::message('message', 'delete');
        $this->session->set('message_admin', $ses_ok); //Записуємо сесію
        
        $this->request->redirect('admin/polloptions');
    }
}