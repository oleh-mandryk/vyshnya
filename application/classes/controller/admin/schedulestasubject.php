<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Розклад занять студентам - предмети
 */
class Controller_Admin_Schedulestasubject extends Controller_Admin {

    public function before() {
        parent::before();
        
        // Вивід в шаблон
        $this->template->submenu = Widget::load('menuschedule');
        $this->template->page_title = 'Предмети';
        $this->template->title = 'Предмети';
    }
    
    public function action_index() {
        
        $count = ORM::factory('schedulesubject')->count_all();
        
        $pagination = Pagination::factory(array(
            'total_items' => $count,
            'items_per_page' => 20))
        
         ->route_params( array(
        'controller' => Request::current()->controller(),
        'action' => Request::current()->action(),
      ));
        
        $subject_current = ORM::factory('schedulesubject')
            ->limit($pagination->items_per_page)
            ->offset($pagination->offset)
            ->order_by('id','DESC')
            ->find_all();
        
        $info_ok = $this->session->get('message_admin');
        
        $content = View::factory('admin/schedule_sta_subject/schedule_sta_subject_index_view', array (
            'subject_current' => $subject_current,
            'pagination' => $pagination,
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
            $schedule_subject = ORM::factory('schedulesubject');
            $schedule_subject->values($data);
                        
            try {
                $schedule_subject->save();
                
                $ses_ok = Kohana::message('message', 'add');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                
                $this->request->redirect('admin/schedulestasubject');
            }
            catch (ORM_Validation_Exception $e) {
                    $errors = $e->errors('validation');
            }
        }

        $content = View::factory('admin/schedule_sta_subject/schedule_sta_subject_add_view')
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
            $this->request->redirect('admin/schedulestasubject');
        }
        
        $schedule_subject = ORM::factory('schedulesubject', $id);
        $data = $schedule_subject->as_array();
        
        // Редагування
        if (isset($_POST['submit'])) {
        
            $data = Arr::extract($_POST, array('title', 'publish_id'));
            
            $schedule_subject->values($data);
            
            try {
                $schedule_subject->save();
                
                $ses_ok = Kohana::message('message', 'edit');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                $this->request->redirect('admin/schedulestasubject');
            }
            
            catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }
        
        $content = View::factory('admin/schedule_sta_subject/schedule_sta_subject_edit_view')
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
        $schedule_subject = ORM::factory('schedulesubject', $id);
        
        if(!$schedule_subject->loaded()){
            $this->request->redirect('admin/schedulestasubject');
        }
        
        $schedule_subject->delete();
        
        $ses_ok = Kohana::message('message', 'delete');
        $this->session->set('message_admin', $ses_ok); //Записуємо сесію
        
        $this->request->redirect('admin/schedulestasubject');
    }
}