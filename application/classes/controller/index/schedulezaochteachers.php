<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Методичні матеріали викладачам
 */
class Controller_Index_Schedulezaochteachers extends Controller_Index {
    
    public function before() {
        parent::before();
        $ses_url = Request::initial()->url();
        $this->session->delete('admin_red');
        $this->session->set('admin_red', $ses_url); //Записуємо сесію
        
        $this->template->styles[] = 'media/css/schedule_content.css';
    }
    
    public function action_index() {
        
        // Отримання всіх викладачів
        $teachers_all = ORM::factory('scheduleteachers')
            ->where('publish_id','=', 1)
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();
        
        // Якщо вибраний викладач
        if (isset($_POST['teacher_id'])) {
        
        $id = $_POST['teacher_id'];
            
        $lessons_current = ORM::factory('schedulezaochlessons')
            ->order_by('date_id','ASC')
            ->order_by('lesson_id','ASC')
            ->where('publish_id','=',1)
            ->where_open()
                ->or_where('teacher1_id','=',$id)
                ->or_where('teacher2_id','=',$id)
                ->or_where('teacher3_id','=',$id)
                ->or_where('teacher4_id','=',$id)
            ->where_close()
            ->find_all();
        }
        
        $year_current_schedule = ORM::factory('setting',2);
        
        $content = View::factory('index/schedule_zaoch/schedule_zaoch_teachers_view')
            ->bind('lessons_current',$lessons_current)
            ->bind('info_ok',$info_ok)
            ->bind('teachers_all', $teachers_all);
        
        // Виводимо в шаблон
        $this->template->title = 'Розклад викладачам заочників на '.$year_current_schedule->value.' навчального року';
        $this->template->page_title = 'Розклад викладачам заочників на '.$year_current_schedule->value.' навчального року';
        $this->template->block_content = array($content);
    }
}