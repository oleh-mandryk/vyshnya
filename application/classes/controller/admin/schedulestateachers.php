<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Розклад занять студентам - викладачі
 */
class Controller_Admin_Schedulestateachers extends Controller_Admin {

    public function before() {
        parent::before();
        
        // Вивід в шаблон
        $this->template->submenu = Widget::load('menuschedule');
        $this->template->page_title = 'Викладачі';
        $this->template->title = 'Викладачі';
    }
    
    public function action_index() {
        
        $count = ORM::factory('scheduleteachers')->count_all();
        
        $pagination = Pagination::factory(array(
            'total_items' => $count,
            'items_per_page' => 20))
        
         ->route_params( array(
        'controller' => Request::current()->controller(),
        'action' => Request::current()->action(),
      ));
        
        $teachers_current = ORM::factory('scheduleteachers')
            ->limit($pagination->items_per_page)
            ->offset($pagination->offset)
            ->order_by('id','DESC')
            ->find_all();
        
        $info_ok = $this->session->get('message_admin');
        
        $content = View::factory('admin/schedule_sta_teachers/schedule_sta_teachers_index_view', array (
            'teachers_current' => $teachers_current,
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
            $schedule_teachers = ORM::factory('scheduleteachers');
            $schedule_teachers->values($data);
                        
            try {
                $schedule_teachers->save();
                
                $ses_ok = Kohana::message('message', 'add');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                
                $this->request->redirect('admin/schedulestateachers');
            }
            catch (ORM_Validation_Exception $e) {
                    $errors = $e->errors('validation');
            }
        }

        $content = View::factory('admin/schedule_sta_teachers/schedule_sta_teachers_add_view')
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
            $this->request->redirect('admin/schedulestateachers');
        }
        
        $schedule_teachers = ORM::factory('scheduleteachers', $id);
        $data = $schedule_teachers->as_array();
        
        // Редагування
        if (isset($_POST['submit'])) {
        
            $data = Arr::extract($_POST, array('title', 'publish_id'));
            
            $schedule_teachers->values($data);
            
            try {
                $schedule_teachers->save();
                
                $ses_ok = Kohana::message('message', 'edit');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                $this->request->redirect('admin/schedulestateachers');
            }
            
            catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }
        
        $content = View::factory('admin/schedule_sta_teachers/schedule_sta_teachers_edit_view')
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
        $schedule_teachers = ORM::factory('scheduleteachers', $id);
        
        if(!$schedule_teachers->loaded()){
            $this->request->redirect('admin/schedulestateachers');
        }
        
        $schedule_teachers->delete();
        
        $ses_ok = Kohana::message('message', 'delete');
        $this->session->set('message_admin', $ses_ok); //Записуємо сесію
        
        $this->request->redirect('admin/schedulestateachers');
    }
}