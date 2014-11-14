<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Базовий клас головної сторінки адміністратора
 */
class Controller_Admin extends Controller_Base {

    public $template = 'admin/base_view';

    public function  before() {
        parent::before();
        
        if (!$this->auth->logged_in('admin')) {
            $this->request->redirect('login');
        }
        
        $menu_admin = Widget::load('menuadmin');

        //Вивід в шаблон
        $this->template->styles[] = 'media/css/main.css';
        $this->template->styles[] = 'media/css/menu_main.css';
        $this->template->styles[] = 'media/css/forms.css';
        $this->template->styles[] = 'media/css/tables.css';
        $this->template->styles[] = 'media/css/menu_sub.css';
        
        $this->template->scripts[] = '/ckeditor/ckeditor.js';
        
        $this->template->block_menu_main = array($menu_admin);
        $this->template->submenu = null;
    }
}