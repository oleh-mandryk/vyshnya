<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Личный кабинет
 */
class Controller_Index_Account extends Controller_Index {

    public function before(){
        parent::before();
        
        $ses_url = Request::initial()->url();
        $this->session->delete('admin_red');
        $this->session->set('admin_red', $ses_url); //Записуємо сесію
        
        if (!$this->auth->logged_in()) {
            $this->request->redirect('login');
        }

        // Виводим в шаблон
        $this->template->submenu = Widget::load('menuaccount');
        
        $this->template->styles[] = 'media/css/menu_sub.css';
    }

    public function action_index() {
        
        $auth = Auth::instance();
        
        $content = View::factory('index/account/account_index_view', array (
                'auth' => $auth,
                'user' => $auth->get_user(),
        ));
                       
        // Выводим в шаблон
        $this->template->title = 'Профіль';
        $this->template->page_title = 'Профіль';
        $this->template->block_content = array($content);
    }
    
    public function action_profile() {
        
        $auth = Auth::instance();
        
        if (isset($_POST['submit'])) {
            
            $oldpass = Arr::get($_POST, 'password_current');
            
            $users = ORM::factory('user');
            
            if ((!$auth->check_password($oldpass))and(!empty($oldpass))) {
                $errors = array(Kohana::message('auth/user', 'password_current'));
            }
            else {
                try {
                    $users->where('id', '=', $this->user->id)
                        ->find()
                        ->update_user($_POST, array(
                            'password',
                            'first_name',
                            'email',
                        ));
                        
                        $ses_ok = Kohana::message('message', 'profile');
                        $this->session->set('message_profile', $ses_ok); //Записуємо сесію

                        $this->request->redirect('account/profile');
                    }
                    catch (ORM_Validation_Exception $e) {
                        $errors = $e->errors('auth');
                    }
            }
        }
        
        $info_ok = $this->session->get('message_profile'); 
        
        $content = View::factory('index/account/account_profile_view')
                        ->bind('user', $this->user)
                        ->bind('errors', $errors)
                        ->bind('info_ok', $info_ok);
                        
        $this->session->delete('message_profile');

        // Выводим в шаблон
        $this->template->title = 'Редагування профілю';
        $this->template->page_title = 'Редагування профілю';
        $this->template->block_content = array($content);
    }
}