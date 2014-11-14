<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Новини
 */
class Controller_Index_News extends Controller_Index {
    
    public function before() {
        parent::before();
        
        $ses_url = Request::initial()->url();
        $this->session->delete('admin_red');
        $this->session->set('admin_red', $ses_url); //Записуємо сесію
        
        $this->template->styles[] = 'media/css/news.css';
    }

    
    public function action_index() {
        
        $count = ORM::factory('new')
            ->where('publish_id', '=', 1)
            ->count_all();

        $pagination = Pagination::factory(array(
            'total_items' => $count,
        ));
        
        
        $all_news = ORM::factory('new')
            ->where('publish_id', '=', 1)
            ->order_by('date','desc')
            ->limit($pagination->items_per_page)
            ->offset($pagination->offset)
            ->find_all();

        $content = View::factory('index/news/news_index_view', array(
            'all_news' => $all_news,
            'pagination' => $pagination,
        ));
        
        // Виводимо в шаблон
        $this->template->title = 'Новини та оголошення';
        $this->template->page_title = 'Новини та оголошення';
        $this->template->block_content = array($content);
        $this->template->block_featured_slide = null;
    }

    public function action_show() {
        $id = (int) $this->request->param('id');
        $news = ORM::factory('new', $id);
        
        if(!$news->loaded() || $news->publish_id == 0 ){
            throw new HTTP_Exception_404('Новину не знайдено');
            return;
        }

        //формуємо масив для оновлення поля count_views (поточне число показів матеріалу +1)
        $counter_data = $news->count_views + 1;
        
        //запускаємо функцію обновлення, яка змінює значення лічильника в базі
        $coun_ok = ORM::factory('new', $id);
        $coun_ok -> count_views = $counter_data;
        $coun_ok -> save();
        
        $content = View::factory('index/news/news_show_view', array(
                'news' => $news,
            ));


        // Виводимо в шаблон
        $this->template->title = $news->title;
        $this->template->page_title = $news->title;
        $this->template->description = $news->description;
        $this->template->keywords = $news->keywords;
        $this->template->block_content = array($content);
    }
}