<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Віджет "Новини"
 */
class Controller_Widgets_News extends Controller_Widgets {
    
    public $template = 'widgets/news_view';

    public function action_index() {
        // Отримуємо список новин
        $all_news = ORM::factory('new')
             ->where('publish_id', '=', 1)
            ->order_by('date','desc')
            ->limit(6)
            ->find_all();
        $this->template->all_news = $all_news;
    }
}