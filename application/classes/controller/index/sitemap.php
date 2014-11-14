<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Карта сайту
 */
class Controller_Index_Sitemap extends Controller_Index {
    
    public function before() {
        parent::before();
        
        $ses_url = Request::initial()->url();
        $this->session->delete('admin_red');
        $this->session->set('admin_red', $ses_url); //Записуємо сесію
        
        $this->template->styles[] = 'media/css/sitemap.css';
    }
    
    public function action_index() {
        $select = Request::initial()->controller();
        
        $menu_main_map = ORM::factory('menumain')->fulltree();
        
        $news_map = ORM::factory('new')->where('publish_id','=',1)->find_all();
                
        $content = View::factory('index/sitemap/sitemap_view', array(
                'menu_main_map' => $menu_main_map,
                'news_map' => $news_map,
        ));
            
        // Виводимо в шаблон
        $this->template->title = 'Карта сайту';
        $this->template->page_title = 'Карта сайту';
        $this->template->block_content = array($content);
        $this->template->select = $select;
    }
}