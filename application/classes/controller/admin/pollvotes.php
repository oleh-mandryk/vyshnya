<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Результати голосування
 */
class Controller_Admin_Pollvotes extends Controller_Admin {

    public function before() {
        parent::before();

        // Вивід в шаблон
        $this->template->submenu = Widget::load('menupolls');
        $this->template->page_title = 'Результати голосування';
        $this->template->title = 'Результати голосування';
    }

    public function action_index() {
    
        $poll_votes = ORM::factory('pollvote')->find_all();

        $info_ok = $this->session->get('message_admin');
        
        $content = View::factory('admin/poll_votes/poll_votes_index_view', array(
            'poll_votes' => $poll_votes,
            'info_ok' => $info_ok,
        ));
        
        $this->session->delete('message_admin');

        // Вивід в шаблон
        $this->template->block_main_content = array($content);
    }
    
    public function action_delete() {
        $id = (int) $this->request->param('id');
        $poll_votes = ORM::factory('pollvote', $id);
        
        if(!$poll_votes->loaded()){
            $this->request->redirect('admin/pollvotes');
        }

        $poll_votes->delete();
        
        $ses_ok = Kohana::message('message', 'delete');
        $this->session->set('message_admin', $ses_ok); //Записуємо сесію
        
        $this->request->redirect('admin/pollvotes');
    }
}