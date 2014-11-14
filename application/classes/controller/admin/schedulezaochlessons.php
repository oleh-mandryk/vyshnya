<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Розклад занять студентам - пари для заочників
 */
class Controller_Admin_Schedulezaochlessons extends Controller_Admin {

    public function before() {
        parent::before();
        
        // Вивід в шаблон
        $this->template->submenu = Widget::load('menuschedule');
        $this->template->page_title = 'Пари для заочників';
        $this->template->title = 'Пари для заочників';
    }
    
    public function action_index() {
        
        $id = (int) $this->request->param('id');
        if(empty($id)) {
            $groups_current = ORM::factory('schedulezaochgroups')
            ->order_by('title','ASC')
            ->find_all();
        
        $info_ok = $this->session->get('message_admin');
        
        $content = View::factory('admin/schedule_zaoch_lessons/schedule_zaoch_groups_index_view', array (
            'groups_current' => $groups_current,
            'info_ok' => $info_ok,
            
        ));
        
        $this->session->delete('message_admin');
        }
        else {
            $group_title = ORM::factory('schedulezaochgroups')->where('id','=',$id)->find();
            
            $lessons_current = ORM::factory('schedulezaochlessons')
            ->order_by('date_id','ASC')
            ->order_by('lesson_id','ASC')
            ->where('group_id','=',$id)
            ->find_all();
        
        $info_ok = $this->session->get('message_admin');
        
        $content = View::factory('admin/schedule_zaoch_lessons/schedule_zaoch_lessons_index_view')
            ->bind('id', $id)
            ->bind('lessons_current',$lessons_current)
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
        
        // Отримання всіх атрибутів для предметів
        $subject_type_all_ad = ORM::factory('schedulesubjecttype')
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();
        
        if (isset($_POST['submit'])) {
            
            $data = Arr::extract($_POST, array('lesson_id', 'subject_id', 'subject_type_id', 'teacher1_id', 'teacher2_id', 'teacher3_id', 'teacher4_id', 'audience1_id', 'audience2_id', 'day_id', 'date_id'));
            
            $date_general = $data['date_id'];
            $month = substr($date_general, 5, 2);
            $year = substr($date_general, 0, 4);
            $day = substr($date_general, 8, 2);
                
            $DaysOfWeek = array("Неділя", "Понеділок", "Вівторок", "Середа", "Четвер", "П'ятниця", "Субота");
            $arr = getdate(mktime(0, 0, 0, $month, $day, $year));
            $day_week = $DaysOfWeek[$arr['wday']];
            
            $schedule_lessons = ORM::factory('schedulezaochlessons');
            $schedule_lessons->values($data);
                     
            try {
                $schedule_lessons->day_id = $day_week;
                $schedule_lessons->group_id = $id;
                
                $schedule_lessons->save();
                
                $ses_ok = Kohana::message('message', 'add');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                
                $this->request->redirect('admin/schedulezaochlessons/index/'.$id);
            }
            catch (ORM_Validation_Exception $e) {
                    $errors = $e->errors('validation');
            }
        }

        $content = View::factory('admin/schedule_zaoch_lessons/schedule_zaoch_lessons_add_view')
            ->bind('id', $id)
            ->bind('errors', $errors)
            ->bind('data', $data)
            ->bind('subject_all_ad',$subject_all_ad)
            ->bind('subject_type_all_ad',$subject_type_all_ad)
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
            $this->request->redirect('admin/schedulezaochlessons');
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
        
        // Отримання всіх атрибутів для предметів
        $subject_type_all_ad = ORM::factory('schedulesubjecttype')
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();
        
        $schedule_lessons = ORM::factory('schedulezaochlessons', $id);
        $group_cur = $schedule_lessons->group_id;
        $data = $schedule_lessons->as_array();
        
        // Редагування
        if (isset($_POST['submit'])) {
        
            $data = Arr::extract($_POST, array('lesson_id', 'subject_id', 'subject_type_id', 'teacher1_id', 'teacher2_id', 'teacher3_id', 'teacher4_id', 'audience1_id', 'audience2_id', 'day_id', 'date_id'));
            
            $date_general = $data['date_id'];
            $month = substr($date_general, 5, 2);
            $year = substr($date_general, 0, 4);
            $day = substr($date_general, 8, 2);
                
            $DaysOfWeek = array("Неділя", "Понеділок", "Вівторок", "Середа", "Четвер", "П'ятниця", "Субота");
            $arr = getdate(mktime(0, 0, 0, $month, $day, $year));
            $day_week = $DaysOfWeek[$arr['wday']];
            
            $schedule_lessons->values($data);
            
            try {
                $schedule_lessons->day_id = $day_week;
                $schedule_lessons->save();
                
                $ses_ok = Kohana::message('message', 'edit');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                $this->request->redirect('admin/schedulezaochlessons/index/'.$group_cur);
            }
            
            catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }
        
        $content = View::factory('admin/schedule_zaoch_lessons/schedule_zaoch_lessons_edit_view')
            ->bind('id', $id)
            ->bind('errors', $errors)
            ->bind('data', $data)
            ->bind('subject_all_ad',$subject_all_ad)
            ->bind('subject_type_all_ad',$subject_type_all_ad)
            ->bind('teacher_all_ad',$teacher_all_ad)
            ->bind('audience_all_ad',$audience_all_ad);
        
        // Вивід в шаблон
        $this->template->page_title .= ' :: Редагування';
        $this->template->title .= ' :: Редагування';
        $this->template->block_main_content = array($content);
    }
    
    public function action_delete() {
        
        $id = (int) $this->request->param('id');
        $schedule_lessons = ORM::factory('schedulezaochlessons', $id);
        $group_cur = $schedule_lessons->group_id;
        
        if(!$schedule_lessons->loaded()){
            $this->request->redirect('admin/schedulezaochlessons');
        }
        
        $schedule_lessons->delete();
        
        $ses_ok = Kohana::message('message', 'delete');
        $this->session->set('message_admin', $ses_ok); //Записуємо сесію
        
        $this->request->redirect('admin/schedulezaochlessons/index/'.$group_cur);
    }
}