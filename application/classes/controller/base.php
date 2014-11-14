<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Базовий контроллер
 */
class Controller_Base extends Controller_Template {
    
    protected $user;
    protected $auth;
    
    public function before() {
        parent::before();
        
        I18n::lang('ua');
        Cookie::$salt = '';
        Session::$default = 'native';
        
        $site_name = ORM::factory('setting',1);
        $this->auth = Auth::instance();
        $this->user = $this->auth->get_user();
        $this->session = Session::instance();
        
        // Вивід в шаблон
        $this->template->site_name = $site_name->value;
        $this->template->page_title = null;
        $this->template->title = null;
        $this->template->description = null;
        $this->template->keywords = null;

        // Підключаємо стилі і скрипти
        $this->template->styles = array();
        $this->template->scripts = array();

        // Підключаємо блоки
        $this->template->block_header = null;
        $this->template->block_main_content = null;
        $this->template->block_content = null;
        $this->template->block_sidebar = null;
        $this->template->block_featured_slide = null;
        $this->template->block_menu_main = null;
        $this->template->block_login = null;
        $this->template->block_search = null;
        $this->template->block_breadcrumb = null;
    }
}