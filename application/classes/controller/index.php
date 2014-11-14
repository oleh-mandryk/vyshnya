<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Базовий клас головної сторінки користувача
 */
class Controller_Index extends Controller_Base {
    
    public $template = 'index/base_view'; // Базовий шаблон

    public function  before() {
        parent::before();
            
$user_agent = $_SERVER['HTTP_USER_AGENT'];
        if (stripos($user_agent, 'MSIE 6.0') !== false && stripos($user_agent, 'MSIE 8.0') === false && stripos($user_agent, 'MSIE 7.0') === false) {
            if (!isset($HTTP_COOKIE_VARS["ie"])) {
                setcookie("ie", "yes", time()+60*60*24*360);
                $this->request->redirect('/ie6/ie6.html');
            }
        }
        
        // Віджети
        $menu_main = Widget::load('menumain');
        $menu_top = Widget::load('menutop');
        $schedule = Widget::load('schedule');
        $methodicalmaterials = Widget::load('methodicalmaterials');
        $wingedphrases = Widget::load('wingedphrases');
        $iwonder = Widget::load('iwonder');
        $search = Widget::load('search');
        $login = Widget::load('login');
        $breadcrumb = Widget::load('breadcrumb');
        $calendar = Widget::load('calendar');
        $polloptionsquestions = Widget::load('polloptionsquestions');
        $login = Widget::load('login');
        $search = Widget::load('search');
        $orphusgoogle = Widget::load('orphusgoogle');
        
        // Вывод в шаблон
        $this->template->styles[] = 'media/css/main.css';
        $this->template->styles[] = 'media/css/menu_main.css';
        $this->template->styles[] = 'media/css/menu_top.css';
        $this->template->styles[] = 'media/css/menu_right.css';
        $this->template->styles[] = 'media/css/forms.css';
        $this->template->styles[] = 'media/css/breadcrumb.css';
        $this->template->styles[] = 'media/css/bottom_bar.css';
        $this->template->styles[] = 'media/css/tables.css';
        $this->template->styles[] = 'media/css/prettyPhoto.css';
         
        $this->template->scripts[] = 'media/js/jquery-1.4.1.min.js';
        $this->template->scripts[] = 'media/js/run.js';
        $this->template->scripts[] = 'media/js/jquery-prettyPhoto.js';
        $this->template->scripts[] = 'media/js/jquery.jcarousel.pack.js';
        $this->template->scripts[] = 'media/js/jquery.jcarousel.setup.js';
        
        $this->template->block_header = $menu_top;
        $this->template->block_login = array($login);
        $this->template->block_search = array($search);
        $this->template->block_breadcrumb = array($breadcrumb); 
        $this->template->block_menu_main = array($menu_main);
        $this->template->submenu = null; 
        $this->template->block_sidebar = array($search, $login, $schedule, $methodicalmaterials, $wingedphrases, $iwonder, $polloptionsquestions, $calendar, $orphusgoogle);        
    }
}