<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Віджет "Авторизації"
 */
class Controller_Widgets_Login extends Controller_Widgets {
   
    public $template = 'widgets/login_view';

    public function action_index() {
        $auth = Auth::instance();
        $this->template->auth = $auth;
        $this->template->user = $auth->get_user();
    
    }
}