<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Розклад занять студентам - пари для стаціонару
 */
class Controller_Admin_Schedulestalessons extends Controller_Admin {

    public function before() {
        parent::before();
        
        // Вивід в шаблон
        $this->template->submenu = Widget::load('menuschedule');
        $this->template->page_title = 'Пари для стаціонару';
        $this->template->title = 'Пари для стаціонару';
    }
    
    public function action_index() {
        
        $id = (int) $this->request->param('id');
        if(empty($id)) {
            $groups_current = ORM::factory('schedulegroups')
            ->order_by('title','ASC')
            ->find_all();
        
        $info_ok = $this->session->get('message_admin');
        
        $content = View::factory('admin/schedule_sta_lessons/schedule_sta_groups_index_view', array (
            'groups_current' => $groups_current,
            'info_ok' => $info_ok,
            
        ));
        
        $this->session->delete('message_admin');
        }
        else {
            $group_title = ORM::factory('schedulegroups')->where('id','=',$id)->find();
            
            $lessons_current_monday = ORM::factory('schedulelessons')
            ->order_by('lesson_id','ASC')
            ->order_by('znam_chusel_id','ASC')
            ->where('day_id','=','Понеділок')
            ->where('group_id','=',$id)
            ->find_all();
            
            $lessons_current_tuesday = ORM::factory('schedulelessons')
            ->order_by('lesson_id','ASC')
            ->order_by('znam_chusel_id','ASC')
            ->where('day_id','=','Вівторок')
            ->where('group_id','=',$id)
            ->find_all();
            
            $lessons_current_wednesday = ORM::factory('schedulelessons')
            ->order_by('lesson_id','ASC')
            ->order_by('znam_chusel_id','ASC')
            ->where('day_id','=','Середа')
            ->where('group_id','=',$id)
            ->find_all();
            
            $lessons_current_thursday = ORM::factory('schedulelessons')
            ->order_by('lesson_id','ASC')
            ->order_by('znam_chusel_id','ASC')
            ->where('day_id','=','Четвер')
            ->where('group_id','=',$id)
            ->find_all();
            
            $lessons_current_friday = ORM::factory('schedulelessons')
            ->order_by('lesson_id','ASC')
            ->order_by('znam_chusel_id','ASC')
            ->where('day_id','=','П\'ятниця')
            ->where('group_id','=',$id)
            ->find_all();
        
        $info_ok = $this->session->get('message_admin');
        
        $content = View::factory('admin/schedule_sta_lessons/schedule_sta_lessons_index_view')
            ->bind('id', $id)
            ->bind('lessons_current_monday',$lessons_current_monday)
            ->bind('lessons_current_tuesday',$lessons_current_tuesday)
            ->bind('lessons_current_wednesday',$lessons_current_wednesday)
            ->bind('lessons_current_thursday',$lessons_current_thursday)
            ->bind('lessons_current_friday',$lessons_current_friday)
            ->bind('info_ok',$info_ok)
            ->bind('group_title',$group_title);
            
        
        $this->session->delete('message_admin');
    }
        // Вивід в шаблон
        $this->template->block_main_content = array($content);
    }
    
    // Додати
    public function action_add() {
        
        $id = (int) $this->request->param('id');
        
        // Отримання всіх предметів
        $subject_all_ad = ORM::factory('schedulesubject')
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();
        
        // Отримання всіх викладачів
        $teacher_all_ad = ORM::factory('scheduleteachers')
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();
               
        // Отримання всіх аудиторій
        $audience_all_ad = ORM::factory('scheduleaudience')
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();
        
        if (isset($_POST['submit'])) {
            
            $data = Arr::extract($_POST, array('lesson_id', 'subject_id', 'teacher1_id', 'teacher2_id', 'teacher3_id', 'teacher4_id', 'audience1_id', 'audience2_id', 'day_id', 'znam_chusel_id', 'publish_id'));
            $schedule_lessons = ORM::factory('schedulelessons');
            $schedule_lessons->values($data);
            
            
                        
            try {
                $schedule_lessons->group_id = $id;
                
                $schedule_lessons->save();
                
                $ses_ok = Kohana::message('message', 'add');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                
                $this->request->redirect('admin/schedulestalessons/index/'.$id);
            }
            catch (ORM_Validation_Exception $e) {
                    $errors = $e->errors('validation');
            }
        }

        $content = View::factory('admin/schedule_sta_lessons/schedule_sta_lessons_add_view')
            ->bind('id', $id)
            ->bind('errors', $errors)
            ->bind('data', $data)
            ->bind('subject_all_ad',$subject_all_ad)
            ->bind('teacher_all_ad',$teacher_all_ad)
            ->bind('audience_all_ad',$audience_all_ad);
        
        // Вивід в шаблон
        $this->template->page_title .= ' :: Додати';
        $this->template->title .= ' :: Додати';
        $this->template->block_main_content = array($content);
    }
    
    public function action_edit() {
        
        $id = (int) $this->request->param('id');
        if(!$id) {
            $this->request->redirect('admin/schedulestalessons');
        }
        
        // Отримання всіх предметів
        $subject_all_ad = ORM::factory('schedulesubject')
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();
        
        // Отримання всіх викладачів
        $teacher_all_ad = ORM::factory('scheduleteachers')
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();
               
        // Отримання всіх аудиторій
        $audience_all_ad = ORM::factory('scheduleaudience')
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();
        
        $schedule_lessons = ORM::factory('schedulelessons', $id);
        $group_cur = $schedule_lessons->group_id;
        $data = $schedule_lessons->as_array();
        
        // Редагування
        if (isset($_POST['submit'])) {
        
            $data = Arr::extract($_POST, array('lesson_id', 'subject_id', 'teacher1_id', 'teacher2_id', 'teacher3_id', 'teacher4_id', 'audience1_id', 'audience2_id', 'day_id', 'znam_chusel_id', 'publish_id'));
            
            $schedule_lessons->values($data);
            
            try {
                $schedule_lessons->save();
                
                $ses_ok = Kohana::message('message', 'edit');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                $this->request->redirect('admin/schedulestalessons/index/'.$group_cur);
            }
            
            catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }
        
        $content = View::factory('admin/schedule_sta_lessons/schedule_sta_lessons_edit_view')
            ->bind('id', $id)
            ->bind('errors', $errors)
            ->bind('data', $data)
            ->bind('subject_all_ad',$subject_all_ad)
            ->bind('teacher_all_ad',$teacher_all_ad)
            ->bind('audience_all_ad',$audience_all_ad);
        
        // Вивід в шаблон
        $this->template->page_title .= ' :: Редагування';
        $this->template->title .= ' :: Редагування';
        $this->template->block_main_content = array($content);
    }
    
    public function action_delete() {
        
        $id = (int) $this->request->param('id');
        $schedule_lessons = ORM::factory('schedulelessons', $id);
        $group_cur = $schedule_lessons->group_id;
        
        if(!$schedule_lessons->loaded()){
            $this->request->redirect('admin/schedulestalessons');
        }
        
        $schedule_lessons->delete();
        
        $ses_ok = Kohana::message('message', 'delete');
        $this->session->set('message_admin', $ses_ok); //Записуємо сесію
        
        $this->request->redirect('admin/schedulestalessons/index/'.$group_cur);
    }
}