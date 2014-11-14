<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Віджет "Статистика"
 */
class Controller_Widgets_Adminstat extends Controller_Widgets {

    public $template = 'widgets/adminstat_view'; // Шаблон виждета
    
    public function action_index() {
        $count['news'] = ORM::factory('new')->count_all();
        $count['pages'] = ORM::factory('page')->count_all();
        $count['winged_phrases'] = ORM::factory('wingedphrase')->count_all();
        $count['i_wonder'] = ORM::factory('iwonder')->count_all();
        $count['mm_v'] = ORM::factory('materialsteachers')->count_all();
        $count['mm_ss'] = ORM::factory('materialsstudents')->count_all();
        $count['photo'] = ORM::factory('photogallery')->count_all();
        $count['users'] = ORM::factory('user')->where('publish_id','=',1)->count_all();

        // Вивід в шаблон
        $this->template->count = $count;
    }
}