<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Розклад занять для студентів
 */
class Controller_Index_Schedulezaoch extends Controller_Index {
    
    public function before() {
        parent::before();
        
        $ses_url = Request::initial()->url();
        $this->session->delete('admin_red');
        $this->session->set('admin_red', $ses_url); //Записуємо сесію
        
        $this->template->styles[] = 'media/css/schedule_content.css';
    }
    
    public function action_index() {
        
        // Отримання всіх груп
        $groups_all = ORM::factory('schedulezaochgroups')
            ->where('publish_id','=', 1)
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();
        
        // Якщо вибрана група
        if (isset($_POST['group_id'])) {
        
        $id = $_POST['group_id'];
            
        $lessons_current = ORM::factory('schedulezaochlessons')
            ->order_by('date_id','ASC')
            ->order_by('lesson_id','ASC')
            ->where('group_id','=',$id)
            ->where('publish_id','=',1)
            ->find_all();
        }
        
        $year_current_schedule = ORM::factory('setting',2);
        
        $content = View::factory('index/schedule_zaoch/schedule_zaoch_view')
            ->bind('lessons_current',$lessons_current)
            ->bind('info_ok',$info_ok)
            ->bind('groups_all', $groups_all);
        
        // Виводимо в шаблон
        $this->template->title = 'Розклад студентам заочникам на '.$year_current_schedule->value.' навчального року';
        $this->template->page_title = 'Розклад студентам заочникам на '.$year_current_schedule->value.' навчального року';
        $this->template->block_content = array($content);
    }
}