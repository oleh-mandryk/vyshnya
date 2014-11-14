<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Розклад занять для студентів
 */
class Controller_Index_Schedulesta extends Controller_Index {
    
    public function before() {
        parent::before();
        
        $ses_url = Request::initial()->url();
        $this->session->delete('admin_red');
        $this->session->set('admin_red', $ses_url); //Записуємо сесію
        
        $this->template->styles[] = 'media/css/schedule_content.css';
    }
    
    public function action_index() {
        
        // Отримання всіх груп
        $groups_all = ORM::factory('schedulegroups')
            ->where('publish_id','=', 1)
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();
        
        // Якщо вибрана група
        if (isset($_POST['group_id'])) {
        
        $id = $_POST['group_id'];
            
        $lessons_current_monday = ORM::factory('schedulelessons')
            ->order_by('lesson_id','ASC')
            ->order_by('znam_chusel_id','ASC')
            ->where('day_id','=','Понеділок')
            ->where('group_id','=',$id)
            ->where('publish_id','=',1)
            ->find_all();
            
            $lessons_current_tuesday = ORM::factory('schedulelessons')
            ->order_by('lesson_id','ASC')
            ->order_by('znam_chusel_id','ASC')
            ->where('day_id','=','Вівторок')
            ->where('group_id','=',$id)
            ->where('publish_id','=',1)
            ->find_all();
            
            $lessons_current_wednesday = ORM::factory('schedulelessons')
            ->order_by('lesson_id','ASC')
            ->order_by('znam_chusel_id','ASC')
            ->where('day_id','=','Середа')
            ->where('group_id','=',$id)
            ->where('publish_id','=',1)
            ->find_all();
            
            $lessons_current_thursday = ORM::factory('schedulelessons')
            ->order_by('lesson_id','ASC')
            ->order_by('znam_chusel_id','ASC')
            ->where('day_id','=','Четвер')
            ->where('group_id','=',$id)
            ->where('publish_id','=',1)
            ->find_all();
            
            $lessons_current_friday = ORM::factory('schedulelessons')
            ->order_by('lesson_id','ASC')
            ->order_by('znam_chusel_id','ASC')
            ->where('day_id','=','П\'ятниця')
            ->where('group_id','=',$id)
            ->where('publish_id','=',1)
            ->find_all();
        }
        
        $year_current_schedule = ORM::factory('setting',2);
        
        $content = View::factory('index/schedule_sta/schedule_sta_view')
            ->bind('lessons_current_monday',$lessons_current_monday)
            ->bind('lessons_current_tuesday',$lessons_current_tuesday)
            ->bind('lessons_current_wednesday',$lessons_current_wednesday)
            ->bind('lessons_current_thursday',$lessons_current_thursday)
            ->bind('lessons_current_friday',$lessons_current_friday)
            ->bind('info_ok',$info_ok)
            ->bind('groups_all', $groups_all);
        
        // Виводимо в шаблон
        $this->template->title = 'Розклад студентам стаціонару на '.$year_current_schedule->value.' навчального року';
        $this->template->page_title = 'Розклад студентам стаціонару на '.$year_current_schedule->value.' навчального року';
        $this->template->block_content = array($content);
    }
}