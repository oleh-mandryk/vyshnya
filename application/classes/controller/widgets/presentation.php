<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Віджет "Презентація"
 */
class Controller_Widgets_Presentation extends Controller_Widgets {
   
    public $template = 'widgets/presentation_view';

    public function action_index() {
        // Отримуємо всі слайди презентації з бази даних
        $slides = ORM::factory('presentation')
            ->order_by('title', 'asc')
            ->where('publish_id', '=', 1)
            ->find_all();
                    
        $this->template->slides = $slides;
    }
}