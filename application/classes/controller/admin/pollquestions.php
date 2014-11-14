<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Запитання для голосування
 */
class Controller_Admin_Pollquestions extends Controller_Admin {

    public function before() {
        parent::before();

        // Вивід в шаблон
        $this->template->submenu = Widget::load('menupolls');
        $this->template->page_title = 'Запитання для голосування';
        $this->template->title = 'Запитання для голосування';
    }

    public function action_index() {
    
        $poll_questions = ORM::factory('pollquestion')->find_all();
        
        $info_ok = $this->session->get('message_admin');
        
        $content = View::factory('admin/poll_questions/poll_questions_index_view', array(
            'poll_questions' => $poll_questions,
            'info_ok' => $info_ok,
        ));
        
        $this->session->delete('message_admin');

        // Вивід в шаблон
        $this->template->block_main_content = array($content);
    }

    public function action_edit() {
        
        $id = (int) $this->request->param('id');
        $poll_questions = ORM::factory('pollquestion', $id);

        if(!$poll_questions->loaded()){
            $this->request->redirect('admin/pollquestions');
        }

        $data = $poll_questions->as_array();

        // Редагування
        if (isset($_POST['submit'])) {
            $data = Arr::extract($_POST, array('value'));
            $poll_questions->values($data);

            try {
                $poll_questions->save();
                
                $ses_ok = Kohana::message('message', 'edit');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                
                $this->request->redirect('admin/pollquestions');
            }
            catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }

        $content = View::factory('admin/poll_questions/poll_questions_edit_view')
                ->bind('id', $id)
                ->bind('errors', $errors)
                ->bind('data', $data);

        // Вивід в шаблон
        $this->template->page_title .= ' :: Редагування';
        $this->template->title .= ' :: Редагування';
        $this->template->block_main_content = array($content);
    }
}