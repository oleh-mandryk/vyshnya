<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Методичні матеріали викладачам
 */
class Controller_Index_Schedulestateachers extends Controller_Index {
    
    public function before() {
        parent::before();
        
        $ses_url = Request::initial()->url();
        $this->session->delete('admin_red');
        $this->session->set('admin_red', $ses_url); //Записуємо сесію
        
        $this->template->styles[] = 'media/css/schedule_content.css';
    }
    
    public function action_index() {
        
        // Отримання всіх груп
        $teachers_all = ORM::factory('scheduleteachers')
            ->where('publish_id','=', 1)
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();
        
        // Якщо вибраний викладач
        if (isset($_POST['teacher_id'])) {
        
        $id = $_POST['teacher_id'];
            
        $lessons_current_monday = ORM::factory('schedulelessons')
            ->order_by('lesson_id','ASC')
            ->order_by('znam_chusel_id','ASC')
            ->where('publish_id','=',1)
            ->where('day_id','=','Понеділок')
            ->where('group_id', '!=', null)
            ->where_open()
                ->or_where('teacher1_id','=',$id)
                ->or_where('teacher2_id','=',$id)
                ->or_where('teacher3_id','=',$id)
                ->or_where('teacher4_id','=',$id)
            ->where_close()
            ->find_all();
            
            $lessons_current_tuesday = ORM::factory('schedulelessons')
            ->order_by('lesson_id','ASC')
            ->order_by('znam_chusel_id','ASC')
            ->where('publish_id','=',1)
            ->where('day_id','=','Вівторок')
            ->where('group_id', '!=', null)
            ->where_open()
                ->or_where('teacher1_id','=',$id)
                ->or_where('teacher2_id','=',$id)
                ->or_where('teacher3_id','=',$id)
                ->or_where('teacher4_id','=',$id)
            ->where_close()
            ->find_all();
            
            $lessons_current_wednesday = ORM::factory('schedulelessons')
            ->order_by('lesson_id','ASC')
            ->order_by('znam_chusel_id','ASC')
            ->where('publish_id','=',1)
            ->where('day_id','=','Середа')
            ->where('group_id', '!=', null)
            ->where_open()
                ->or_where('teacher1_id','=',$id)
                ->or_where('teacher2_id','=',$id)
                ->or_where('teacher3_id','=',$id)
                ->or_where('teacher4_id','=',$id)
            ->where_close()
            ->find_all();
            
            $lessons_current_thursday = ORM::factory('schedulelessons')
            ->order_by('lesson_id','ASC')
            ->order_by('znam_chusel_id','ASC')
            ->where('publish_id','=',1)
            ->where('day_id','=','Четвер')
            ->where('group_id', '!=', null)
            ->where_open()
                ->or_where('teacher1_id','=',$id)
                ->or_where('teacher2_id','=',$id)
                ->or_where('teacher3_id','=',$id)
                ->or_where('teacher4_id','=',$id)
            ->where_close()
            ->find_all();
            
            $lessons_current_friday = ORM::factory('schedulelessons')
            ->order_by('lesson_id','ASC')
            ->order_by('znam_chusel_id','ASC')
            ->where('publish_id','=',1)
            ->where('day_id','=','П\'ятниця')
            ->where('group_id', '!=', null)
            ->where_open()
                ->or_where('teacher1_id','=',$id)
                ->or_where('teacher2_id','=',$id)
                ->or_where('teacher3_id','=',$id)
                ->or_where('teacher4_id','=',$id)
            ->where_close()
            ->find_all();
        }
        
       $year_current_schedule = ORM::factory('setting',2);
        
        $content = View::factory('index/schedule_sta/schedule_sta_teachers_view')
            ->bind('lessons_current_monday',$lessons_current_monday)
            ->bind('lessons_current_tuesday',$lessons_current_tuesday)
            ->bind('lessons_current_wednesday',$lessons_current_wednesday)
            ->bind('lessons_current_thursday',$lessons_current_thursday)
            ->bind('lessons_current_friday',$lessons_current_friday)
            ->bind('info_ok',$info_ok)
            ->bind('teachers_all', $teachers_all);
        
        // Виводимо в шаблон
        $this->template->title = 'Розклад викладачам стаціонару на '.$year_current_schedule->value.' навчального року';
        $this->template->page_title = 'Розклад викладачам стаціонару на '.$year_current_schedule->value.' навчального року';
        $this->template->block_content = array($content);
    }
}