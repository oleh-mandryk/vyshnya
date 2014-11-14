<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Авторизація
 */
class Controller_Index_Auth extends Controller_Index {
    
    public function action_index() {
        $this->action_login();
    }
    
    //Функція для авторизації
    public function action_login() {
        if (Auth::instance()->logged_in()) {
            $this->request->redirect();
        }
        else {
            
            if (isset($_POST['submit'])) {
            $data = Arr::extract($_POST, array('username', 'password', 'remember'));
            $data = Security::xss_clean($data);
            $users = ORM::factory('user')->where('username','=',$data['username'])->find();
            
            if (($users->username != null) and ($users->publish_id == 1)) {
                $status = Auth::instance()->login($data['username'], $data['password'], (bool) $data['remember']);
                $red_ok = $this->session->get('admin_red');
                if ($status) {
                    if(Auth::instance()->logged_in('admin')) {
                        $this->request->redirect('admin');
                    }
                    $this->request->redirect($red_ok);
                }
                else {
                    $errors = array(Kohana::message('auth/user', 'no_user'));
                
                }
            }
            else {
                if (($users->username != null)and ($users->publish_id == 0)) {
                    $errors = array(Kohana::message('auth/user', 'no_active'));
                }
                else {
                    $errors = array(Kohana::message('auth/user', 'no_user'));
                }
                
            } 
        }
        $content = View::factory('index/auth/auth_login_view')
                    ->bind('errors', $errors)
                    ->bind('data', $data);

        // Выводим в шаблон
        $this->template->title = 'Вхід';
        $this->template->page_title = 'Вхід';
        $this->template->block_content = array($content);
        }
    }
    
    //Функція для реєстрації
    public function action_register() {
        
        $auth = Auth::instance();
        
        if(!$auth->logged_in()):
        
        $captcha = Captcha::instance();
        
        if (isset($_POST['submit'])) {
            
            $data = Arr::extract($_POST, array('username', 'password', 'first_name', 'second_name', 'third_name', 'day1_id', 'day2_id', 'day3_id', 'password_confirm', 'email', 'type_register', 'captcha'));
            $data = Security::xss_clean($data);
            $users = ORM::factory('user');
            
            $validate = Validation::factory($_POST);
            $validate->rule('captcha','not_empty');
            $validate->rule('type_register','not_empty');
            $validate->rule('captcha','Captcha::valid');
            $validate->label('captcha', 'Введіть цифри з картинки');
            $validate->label('type_register', 'Тип реєстрації');
            
            if ($validate->check()) {
                $kkk = 1;
            }
            else {
                $errors_cap = $validate->errors('captcha');
                $kkk = 0;
            }
            try {
                $jjj =1;
                $users->check_user($_POST, array(
                    'username',
                    'first_name',
                    'second_name',
                    'third_name',
                    'day1_id',
                    'day2_id',
                    'day3_id',
                    'password',
                    'email',
                ));
            }
            catch (ORM_Validation_Exception $e) {
                $jjj = 0;
                $errors = $e->errors('auth');
            }
            if (($jjj!= 0)and($kkk == 1)) {
                $users->create_user($_POST, array(
                    'username',
                    'first_name',
                    'second_name',
                    'third_name',
                    'day1_id',
                    'day2_id',
                    'day3_id',
                    'password',
                    'email',
                ));
                
                $pass = $data['password'];
                $pass = Encrypt::instance()->encode($pass);
                $usertemp = ORM::factory('user')->where('username','=',$data['username'])->find();
                $id_upd = $usertemp->id;
                $query=DB::update('users')
                    ->set(array('encryptpass' => $pass))
                    ->where('id','=',$id_upd);
                $query->execute();
                
                $query=DB::update('users')
                    ->set(array('date' => date ("Y-m-d")))
                    ->where('id','=',$id_upd);
                $query->execute();
                
                switch ($data['type_register']) {
                    case 1:
                        $role = ORM::factory('role')->where('name', '=', 'teacher')->find();
                        $users->add('roles', $role);
                        
                        $role = ORM::factory('role')->where('name', '=', 'login')->find();
                        $users->add('roles', $role);
                    break;
                    
                    case 2:
                        $role = ORM::factory('role')->where('name', '=', 'login')->find();
                        $users->add('roles', $role);
                    break;
                }
                $ses_ok = Kohana::message('message', 'register');
                $this->session->set('message_register', $ses_ok); //Записуємо сесію
                    
                $this->request->redirect('register');
            }
        }
        $info_ok = $this->session->get('message_register'); 

        $content = View::factory('index/auth/auth_register_view')
            ->bind('captcha', $captcha)
            ->bind('errors', $errors)
            ->bind('errors_cap', $errors_cap)
            ->bind('data', $data)
            ->bind('info_ok', $info_ok)
            ->bind('auth', $auth);
        
        $this->session->delete('message_register');

        // Виводимо в шаблон
        $this->template->title = 'Реєстрація';
        $this->template->page_title = 'Реєстрація';
        $this->template->block_content = array($content);
        
        else:
        $this->request->redirect();
        endif;
    }
    
    //функція для відновлення пароллю, відсилає на email верифікаційний код
    public function action_restore_password() {
        $auth = Auth::instance();
        
        if(!$auth->logged_in()):
            
            if (isset($_POST['submit'])) {
            
                $post = Validation::factory($_POST);
                
                $post->rule('email','not_empty');
                $post->rule('email','email');
                $post->label('email','Email');
                $email_current = $_POST['email'];
                $email_current = Security::xss_clean($email_current);
                
                if($post->check()) {
                    $users = ORM::factory('user')->where('email', '=', $email_current)->find();
                    $symbols = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                    $genpass = Text::random($symbols, 8);
                    $hashpass = $auth->hash_password($genpass);
                    $users->rempass = $hashpass;
                    $users->save();
                    
                    //Відправлення електронної пошти
                    $url_site = URL::base();
                    $text_massage = "
                    <p>Привіт {$users->username}.</p>
                    <p>Ви отримали цей лист тому, що ви (або хтось, що видає себе за вас) попросили вислати новий пароль до вашого облікового запису на сайті {$url_site}. Якщо ви не просили вислати пароль, то не звертайте уваги на цей лист.</p>
                    <p>Перш ніж використовувати новий пароль, ви повинні його активізувати. Для цього перейдіть за посиланням:</p>
                    <p><a href='{$url_site}auth/checkcode/$hashpass'>{$url_site}auth/checkcode/$hashpass</a></p>
                    <p>У разі успішної актівізації ви зможете входити в систему, використовуючи Наступний пароль:</p>
                    <p>Пароль: <strong>$genpass</strong></p>
                    <p>Ви зможете змінити цей пароль на сторінці редагування профілю.</p>";
                    
                    $site_name = ORM::factory('setting',1);
                    $admin_email = ORM::factory('setting',3);
                    $user_email = $email_current;
                    
                    //Куда відправляється повідомлення
                    $subject = "=?windows-1251?B?".base64_encode(iconv("UTF-8", "windows-1251", "Відновлення паролю"))."?=";
                    $headers = "Content-type: text/html; charset=UTF-8 \r\n";
                    $headers .= "From: < $admin_email->value>\r\n"; 
                    //$headers .= "From: =?windows-1251?B?".base64_encode(iconv("UTF-8", "windows-1251", "$site_name->value"))."?=";
                    //Відправляємо повідомлення
                    mail($user_email,$subject,$text_massage, $headers);
                    
                    //$email = Email::factory('Відновлення паролю', $text_massage, 'text/html')
                        //->to($user_email, $users->username)
                        //->from($admin_email->value, $site_name->value)
                        //->send();
                    
                    $ses_ok = Kohana::message('message', 'restore');
                    $this->session->set('message_register', $ses_ok); //Записуємо сесію
                    $this->request->redirect('restore_password');
                }
                else {
                    $errors = $post->errors('validation');
                }
            }
            
            $info_ok = $this->session->get('message_register'); 
            
            $content = View::factory('index/auth/auth_restore_password_view')
                ->bind('errors', $errors)
                ->bind('info_ok', $info_ok)
                ->bind('auth', $auth);
                
            $this->session->delete('message_register');
                
            //Виводим в шаблон
            $this->template->title = 'Відновлення забутого паролю';
            $this->template->page_title = 'Відновлення забутого паролю';
            $this->template->block_content = array($content);
        
        else:
        $this->request->redirect();
        endif;  
    }
    
    //функція для відновлення паролю, викликається через посилання, яке приходить на еmail
    public function action_checkcode() {
        
        $auth = Auth::instance();
        
        $code = $this->request->param('id');
        $usertemp = ORM::factory('user')->where('rempass','=',$code)->find();
        if (empty($usertemp->username)) {
            $this->request->redirect();
        }
        else {
            $genpass = $code;
            $id_upd = $usertemp->id;
            $usertemp->rempass = NULL;
            $query=DB::update('users')
                ->set(array('password' => $genpass))
                ->where('id','=',$id_upd);
            $query->execute();
            $usertemp->save();
            $ses_ok = Kohana::message('message', 'restore_ok');
            $this->session->set('message_register', $ses_ok); //Записуємо сесію
            $this->request->redirect('restore_password');
        }
    }
    
    public function action_logout() {
        Auth::instance()->logout();
        $red_ok = $this->session->get('admin_red');
        $this->session->delete('admin_red');
        $this->request->redirect($red_ok);
    }
}