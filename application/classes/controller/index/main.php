<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Головна сторінка
 */
class Controller_Index_Main extends Controller_Index {
    
    public function before() {
        parent::before();
        
        $ses_url = Request::initial()->url();
        $this->session->delete('admin_red');
        $this->session->set('admin_red', $ses_url); //Записуємо сесію
        
        $this->template->styles[] = 'media/css/news.css';
        $this->template->styles[] = 'media/css/featured_slide.css';
    }


    public function action_index() {
        $block_main = ORM::factory('page')
            ->where('alias', '=', 'index')
            ->find();
        $presentation = Widget::load('presentation');
        $news = Widget::load('news');
        $login = Widget::load('login');
        $search = Widget::load('search');
       
        // Вивід в шаблон
        $this->template->title = 'Головна';
        $this->template->page_title = $block_main->title;
        $this->template->description = $block_main->description;
        $this->template->keywords = $block_main->keywords;
        $this->template->block_content = array($block_main->content);
        $this->template->block_sidebar = array($search, $login);
        $this->template->block_main_content = array($news);
        $this->template->block_featured_slide = $presentation;
        $this->template->block_breadcrumb = null;
    }
}