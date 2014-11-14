<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Розклад занять студентам - заочні групи
 */
class Controller_Admin_Schedulezaochgroups extends Controller_Admin {

    public function before() {
        parent::before();
        
        // Вивід в шаблон
        $this->template->submenu = Widget::load('menuschedule');
        $this->template->page_title = 'Заочні групи';
        $this->template->title = 'Заочні групи';
    }
    
    public function action_index() {
        
        $groups_current = ORM::factory('schedulezaochgroups')
            ->order_by('id','DESC')
            ->find_all();
        
        $info_ok = $this->session->get('message_admin');
        
        $content = View::factory('admin/schedule_zaoch_groups/schedule_zaoch_groups_index_view', array (
            'groups_current' => $groups_current,
            'info_ok' => $info_ok,
            
        ));
        
        $this->session->delete('message_admin');

        // Вивід в шаблон
        $this->template->block_main_content = array($content);
    }
    
    // Додати
    public function action_add() {
        
        if (isset($_POST['submit'])) {
        
            $data = Arr::extract($_POST, array('title', 'publish_id'));
            $schedule_groups = ORM::factory('schedulezaochgroups');
            $schedule_groups->values($data);
                        
            try {
                $schedule_groups->save();
                
                $ses_ok = Kohana::message('message', 'add');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                
                $this->request->redirect('admin/schedulezaochgroups');
            }
            catch (ORM_Validation_Exception $e) {
                    $errors = $e->errors('validation');
            }
        }

        $content = View::factory('admin/schedule_zaoch_groups/schedule_zaoch_groups_add_view')
            ->bind('errors', $errors)
            ->bind('data', $data);
        
        // Вивід в шаблон
        $this->template->page_title .= ' :: Додати';
        $this->template->title .= ' :: Додати';
        $this->template->block_main_content = array($content);
    }
    
    public function action_edit() {
        
        $id = (int) $this->request->param('id');
        if(!$id) {
            $this->request->redirect('admin/schedulezaochgroups');
        }
        
        $schedule_groups = ORM::factory('schedulezaochgroups', $id);
        $data = $schedule_groups->as_array();
        
        // Редагування
        if (isset($_POST['submit'])) {
        
            $data = Arr::extract($_POST, array('title', 'publish_id'));
            
            $schedule_groups->values($data);
            
            try {
                $schedule_groups->save();
                
                $ses_ok = Kohana::message('message', 'edit');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                $this->request->redirect('admin/schedulezaochgroups');
            }
            
            catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }
        
        $content = View::factory('admin/schedule_zaoch_groups/schedule_zaoch_groups_edit_view')
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
        $schedule_groups = ORM::factory('schedulezaochgroups', $id);
        
        if(!$schedule_groups->loaded()){
            $this->request->redirect('admin/schedulezaochgroups');
        }
        
        $schedule_groups->delete();
        
        $ses_ok = Kohana::message('message', 'delete');
        $this->session->set('message_admin', $ses_ok); //Записуємо сесію
        
        $this->request->redirect('admin/schedulezaochgroups');
    }
}