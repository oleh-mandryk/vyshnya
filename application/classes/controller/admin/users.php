<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Користувачі
 */
class Controller_Admin_Users extends Controller_Admin {

    public function before() {
        parent::before();

        // Вивід в шаблон
        $this->template->page_title = 'Всі користувачі';
        $this->template->title = 'Всі користувачі';
    }

    public function action_index() {
        $count = ORM::factory('user')->count_all();
        
        $pagination = Pagination::factory(array(
            'total_items' => $count,
            'items_per_page' => 20))
            ->route_params( array(
                'controller' => Request::current()->controller(),
                'action' => Request::current()->action(),
        ));
        $users = ORM::factory('user')
            ->order_by('id','desc')
            ->limit($pagination->items_per_page)
            ->offset($pagination->offset)
            ->find_all();
            
        $info_ok = $this->session->get('message_admin');

        $content = View::factory('admin/users/users_index_view', array(
            'users' => $users,
            'info_ok' => $info_ok,
            'pagination' => $pagination,
        ));
        
        $this->session->delete('message_admin');

        // Вивід в шаблон
        $this->template->block_main_content = array($content);
    }

    public function action_edit() {
        
        $id = (int) $this->request->param('id');
        
        $users = ORM::factory('user', $id);
        
        $rol = $users->roles->where('name','=','admin')->count_all();
        if ($rol != '0') {
            $view_select = 'users_edit_admin_view';
            $way = 'admin';
        }
        else {
            $view_select = 'users_edit_view';
            $way = 'login';
        }
        
        if (isset($_POST['submit'])) {
            
            try {
                
                switch ($way) {
                    case 'admin':
                        $users->update_user($_POST, array(
                        'username',
                        'first_name',
                        'second_name',
                        'third_name',
                        'email',
                    ));
                    
                    $ses_ok = Kohana::message('message', 'edit');
                    $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                    
                    break;
                    
                    case 'login':
                        $pass = $users->encryptpass;
                        $data = Arr::extract($_POST, array('first_name', 'second_name', 'third_name','publish_id'));
                        $users->values($data);
                        $users->save();
                        if ($users->publish_id == 1) {
                            
                            //Відправлення електронної пошти
                            $url_site = URL::base();
                            $site_name = ORM::factory('setting',1);
                            $pass = Encrypt::instance()->decode($pass);
                            $text_massage = "
                            <h2>Ви зареєструвалися на {$site_name->value}, {$users->username}!</h2>
                            <p>Ваше ім'я користувача <strong>{$users->username}</strong> і пароль <strong>{$pass}</strong></p>
                            <p>Ви можете змінити пароль та інформацію про себе після того як увійдете в налаштування Вашого профілю</p>
                            <p>Дякуємо за те, що зареєструвалися на нашому сайті.</p>
                            <p><em>З повагою,</em><br/>
                            Адміністрація {$site_name->value}</p>
                            <p>P.S. Не відповідайте на цей лист!</p>";
                            $admin_email = ORM::factory('setting',3);
                            $user_email = $users->email;
                            
                            //Куда відправляється повідомлення
                            $subject = "=?windows-1251?B?".base64_encode(iconv("UTF-8", "windows-1251", "Відновлення паролю"))."?=";
                            $headers = "Content-type: text/html; charset=UTF-8 \r\n";
                            $headers .= "From: <$admin_email->value>\r\n"; 
                            
                            //Відправляємо повідомлення
                            mail($user_email, $subject, $text_massage, $headers);
                            
                            
                           // $email = Email::factory('Реєстрація завершена', $text_massage, 'text/html')
//                                ->to($user_email, $users->username)
//                                ->from($admin_email->value, $site_name->value)
//                                ->send();
                                
                            $users->encryptpass = '';
                            $users->save();
                        }
                        
                        $ses_ok = Kohana::message('message', 'activation');
                        $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                    break;
                    
                }
                
            $this->request->redirect('admin/users');
            }
            catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('auth');
            }
        }
            
        $content = View::factory('admin/users/'.$view_select)
            ->bind('user', $users)
            ->bind('errors', $errors);

            // Выводим в шаблон
            $this->template->page_title .= ' :: Редагування';
            $this->template->title .= ' :: Редагування';
            $this->template->block_main_content = array($content);
        }    
    
    
    public function action_delete() {
        $id = (int) $this->request->param('id');
        $users = ORM::factory('user', $id);

        if(!$users->loaded()){
            $this->request->redirect('admin/users');
        }

        //Відправлення електронної пошти
        $url_site = URL::base();
        $site_name = ORM::factory('setting',1);
        $text_massage = "
        <h2>{$users->username} ви реєструвались на {$site_name->value}!</h2>
        <p>Ваші особисті дані, введені при реєстрації є некоректними. Тому система Вас не зареєструвала.</p>
        <p>Повторно виконайте реєстарцію - коректно ввівши особисті дані!</p>
        <p><em>З повагою,</em><br/>
        Адміністрація {$site_name->value}</p>
        <p>P.S. Не відповідайте на цей лист!</p>";
                            
        $admin_email = ORM::factory('setting',3);
        $user_email = $users->email;
                            
        //Куда відправляється повідомлення
        $subject = "=?windows-1251?B?".base64_encode(iconv("UTF-8", "windows-1251", "Відновлення паролю"))."?=";
        $headers = "Content-type: text/html; charset=UTF-8 \r\n";
        $headers .= "From: <$admin_email->value>\r\n"; 
                            
        //Відправляємо повідомлення
        mail($user_email, $subject, $text_massage, $headers);
        
        
        //$email = Email::factory('Відмова в реєстрації', $text_massage, 'text/html')
//            ->to($user_email, $users->username)
//            ->from($admin_email->value, $site_name->value)
//            ->send();
        
        $users->delete();
        
        $ses_ok = Kohana::message('message', 'delete');
        $this->session->set('message_admin', $ses_ok); //Записуємо сесію
        
        $this->request->redirect('admin/users');
    }
}