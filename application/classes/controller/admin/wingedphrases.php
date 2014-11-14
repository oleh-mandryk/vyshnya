<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Крилаті фрази
 */
class Controller_Admin_Wingedphrases extends Controller_Admin {

    public function before() {
        parent::before();

        // Вивід в шаблон
        $this->template->submenu = Widget::load('menumaterials');
        $this->template->page_title = 'Крилаті фрази';
        $this->template->title = 'Крилаті фрази';
    }

    public function action_index() {
        
        $count = ORM::factory('wingedphrase')->count_all();
        
        $pagination = Pagination::factory(array(
            'total_items' => $count,
            'items_per_page' => 20))
            
         ->route_params( array(
        'controller' => Request::current()->controller(),
        'action' => Request::current()->action(),
      ));
        
        $wingedphrases = ORM::factory('wingedphrase')
            ->order_by('id','desc')
            ->limit($pagination->items_per_page)
            ->offset($pagination->offset)
            ->find_all();
        
        $info_ok = $this->session->get('message_admin');
        
        $content = View::factory('admin/wingedphrases/wingedphrases_index_view', array(
            'wingedphrases' => $wingedphrases,
            'pagination' => $pagination,
            'info_ok' => $info_ok,
        ));
        
        $this->session->delete('message_admin');

        // Вивід в шаблон
        $this->template->block_main_content = array($content);
    }

    public function action_add() {

        if (isset($_POST['submit'])) {
            $data = Arr::extract($_POST, array('content', 'author', 'publish_id'));
            $wingedphrases = ORM::factory('wingedphrase');
            $wingedphrases->values($data);

            try {
                $wingedphrases->save();
                
                $ses_ok = Kohana::message('message', 'add');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                
                $this->request->redirect('admin/wingedphrases');
            }
            catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }

        $content = View::factory('admin/wingedphrases/wingedphrases_add_view')
                ->bind('errors', $errors)
                ->bind('data', $data);

        // Вивід в шаблон
        $this->template->page_title .= ' :: Додавання';
        $this->template->title .= ' :: Додавання';
        $this->template->block_main_content = array($content);
    }

    public function action_edit() {
        
        $id = (int) $this->request->param('id');
        $wingedphrases = ORM::factory('wingedphrase', $id);

        if(!$wingedphrases->loaded()){
            $this->request->redirect('admin/wingedphrases');
        }

        $data = $wingedphrases->as_array();

        // Редагування
        if (isset($_POST['submit'])) {
            $data = Arr::extract($_POST, array('content', 'author', 'publish_id'));
            $wingedphrases->values($data);

            try {
                $wingedphrases->save();
                
                $ses_ok = Kohana::message('message', 'edit');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                
                $this->request->redirect('admin/wingedphrases');
            }
            catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }

        $content = View::factory('admin/wingedphrases/wingedphrases_edit_view')
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
        $wingedphrases = ORM::factory('wingedphrase', $id);
        
        if(!$wingedphrases->loaded()){
            $this->request->redirect('admin/wingedphrases');
        }

        $wingedphrases->delete();
        
        $ses_ok = Kohana::message('message', 'delete');
        $this->session->set('message_admin', $ses_ok); //Записуємо сесію
        
        $this->request->redirect('admin/wingedphrases');
    }
}