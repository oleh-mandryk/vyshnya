<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Юридична консультація
 */
class Controller_Index_LegalAdvice extends Controller_Index {

    public function before(){
        parent::before();
        
        $ses_url = Request::initial()->url();
        $this->session->delete('admin_red');
        $this->session->set('admin_red', $ses_url); //Записуємо сесію
        
        if ((!$this->auth->logged_in('legaladvice'))&&(!$this->auth->logged_in('admin'))) {
            $this->request->redirect('login');
        }
        $this->template->scripts[] = '/ckeditor/ckeditor.js';
    }
    
    public function action_index() {
        
        $auth = Auth::instance();
        
        $count = ORM::factory('legaladvice')->count_all();
        
        $pagination = Pagination::factory(array(
            'total_items' => $count,
            'items_per_page' => 20))
        
         ->route_params( array(
        'controller' => Request::current()->controller(),
        'action' => Request::current()->action(),
      ));
        
        $legaladvice = ORM::factory('legaladvice')
            ->order_by('id','desc')
            ->limit($pagination->items_per_page)
            ->offset($pagination->offset)
            ->find_all();

        $info_ok = $this->session->get('message_legaladvice'); 
        
        $content = View::factory('index/legal_advice/legal_advice_view')
                        ->bind('legaladvice', $legaladvice)
                        ->bind('user', $this->user)
                        ->bind('pagination', $pagination)
                        ->bind('info_ok', $info_ok);
                        
        $this->session->delete('message_legaladvice');

        // Выводим в шаблон
        $this->template->title = 'Юридична консультація: запитання і відповіді';
        $this->template->page_title = 'Юридична консультація: запитання і відповіді';
        $this->template->block_content = array($content);
    }
    
    public function action_edit() {
        $auth = Auth::instance();
        $id = (int) $this->request->param('id');
        $legaladvice = ORM::factory('legaladvice', $id);

        if(!$legaladvice->loaded()){
            $this->request->redirect('legaladvice');
        }

        $data = $legaladvice->as_array();

        // Редагування
        if (isset($_POST['submit'])) {
            $data1 = Arr::extract($_POST, array('answer', 'status'));
            $legaladvice->values($data1);
            $user = $auth->get_user();
            $user1 = $user->first_name.' '.UTF8::substr($user->second_name, 0, 1).'.'.UTF8::substr($user->third_name, 0, 1).'.';
            $legaladvice->author_answer = $user1;
            $legaladvice->date_answer = date ("Y-m-d");
            $legaladvice->save();
            $ses_ok = Kohana::message('message', 'edit');
            $this->session->set('message_legaladvice', $ses_ok); //Записуємо сесію
            $this->request->redirect('legaladvice');    
        }

        $content = View::factory('index/legal_advice/legal_advice_edit_view')
                ->bind('id', $id)
                ->bind('errors', $errors)
                ->bind('data', $data);

        // Вивід в шаблон
        $this->template->page_title = 'Юридична консультація: запитання і відповіді';
        $this->template->title = 'Юридична консультація: запитання і відповіді';
        $this->template->block_content = array($content);
    }
    
    public function action_delete() {
        $id = (int) $this->request->param('id');
        $legaladvice = ORM::factory('legaladvice', $id);
        
        if(!$legaladvice->loaded()){
            $this->request->redirect('legaladvice');
        }
        
        $legaladvice->delete();
        
        $ses_ok = Kohana::message('message', 'delete');
        $this->session->set('message_legaladvice', $ses_ok); //Записуємо сесію
        
        $this->request->redirect('legaladvice');
    }
}