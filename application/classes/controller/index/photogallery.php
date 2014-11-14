<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Фотогалерея
 */
class Controller_Index_Photogallery extends Controller_Index {


    public function before() {
        parent::before();
        
        $ses_url = Request::initial()->url();
        $this->session->delete('admin_red');
        $this->session->set('admin_red', $ses_url); //Записуємо сесію
        
        $this->template->styles[] = 'media/css/photogallery.css';
    }
    
    public function action_index() {
        
        $photo_alias = $this->request->param('photo_alias');
        
        if (empty ($photo_alias)) {
            
            $photo_sections = ORM::factory('menuphotogallery')
                ->order_by('title','asc')
                ->where('publish_id','=',1)
                ->find_all();
        
            $content = View::factory('index/photogallery/photogallery_sections_view', array(
                'photo_sections' => $photo_sections,
            ));
            
            // Виводимо в шаблон
            $this->template->title = 'Фотогалерея';
            $this->template->page_title = 'Фотогалерея';
            $this->template->block_content = array($content);
        }
        else {
            
            $id_sec = ORM::factory('menuphotogallery')
                ->where('alias', '=', $photo_alias)
                ->where('publish_id','=',1)
                ->find();
            
            $count = ORM::factory('photogallery')
                ->where('section_id', '=', $id_sec)
                ->where('publish_id','=',1)
                ->count_all();
        
            if(empty($count)) {
                throw new HTTP_Exception_404('В даній категорії фотографій не знайдено');
                return;
            }
            
            $pagination = Pagination::factory(array(
            'total_items' => $count,
            'items_per_page' => 20));
        
            $photo = ORM::factory('photogallery')
                ->where('section_id', '=', $id_sec)
                ->where('publish_id','=',1)
                ->order_by('date','desc')
                ->limit($pagination->items_per_page)
                ->offset($pagination->offset)
                ->find_all();
            
            $content = View::factory('index/photogallery/photogallery_show_view', array(
                'photo' => $photo,
                'pagination' => $pagination,
                
            ));
            
            // Виводимо в шаблон
            $this->template->title = 'Фотогалерея :: '.  $id_sec->title;
            $this->template->page_title = $id_sec->title;
            $this->template->block_content = array($content);
        }
    }
}