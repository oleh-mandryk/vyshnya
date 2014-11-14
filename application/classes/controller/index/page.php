<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Сторінки
 */
class Controller_Index_Page extends Controller_Index {
    
    public function before() {
        parent::before();
        
        $ses_url = Request::initial()->url();
        $this->session->delete('admin_red');
        $this->session->set('admin_red', $ses_url); //Записуємо сесію
        
        $this->template->styles[] = 'media/css/presentation.css';
        $this->template->scripts[] = 'media/js/jquery.min.js';
        $this->template->scripts[] = 'media/js/legaladvice.js';
        $this->template->scripts[] = 'media/js/add_legaladvice.js';
       
    }
    
    // Статичні сторінки
    public function action_index() {
        
        $page_alias = $this->request->param('page_alias');
        
        if ($page_alias == 'index') {
            $this->request->redirect();
        }
        
        $page = ORM::factory('page')->where('alias', '=', $page_alias)->find();

        if(!$page->loaded() || $page->publish_id == 0) {
            throw new HTTP_Exception_404('Сторінка не знайдена');
            return;
        }
        
        $content = View::factory('index/page/page_index_view', array(
            'page' => $page,
        ));
        
        // Виводимо в шаблон
        $this->template->title = $page->title;
        $this->template->page_title = $page->title;
        $this->template->description = $page->description;
        $this->template->keywords = $page->keywords;
        $this->template->block_content = array($content);
    }
    
    // Сторінка Контакти
    public function action_contact() {
    
        $captcha = Captcha::instance();
        
        $page = ORM::factory('page')->where('alias', '=', 'contact')->find();
        
        if (isset($_POST['send'])) {
            
            $post = Validation::factory($_POST);
            
            $post->rule('name','not_empty');
            $post->rule('email','not_empty');
            $post->rule('email','email');
            $post->rule('subject','not_empty');
            $post->rule('text','not_empty');
            $post->rule('captcha','not_empty');
            $post->rule('captcha','Captcha::valid');
            $post->label('name', 'Ім\'я');
            $post->label('email', 'Email');
            $post->label('subject', 'Тема повідомлення');
            $post->label('text', 'Повідомлення');
            $post->label('captcha', 'Каптча');
            
            $data = Arr::extract($_POST, array('name', 'email','subject','text', 'captcha'));
            $data = Security::xss_clean($data);
            
            if($post->check()) {
                //$site_name = ORM::factory('setting',1);
                $admin_email = ORM::factory('setting',3);
                
                $subject = "=?windows-1251?B?".base64_encode(iconv("UTF-8", "windows-1251", $data['subject']))."?=";
                $headers = "Content-type: text/html; charset=UTF-8 \r\n";
                $headers .= "From: <$admin_email->value>\r\n"; 
                $message = "<strong>Написав(ла):</strong> {$data['name']} <br /> <strong>Тема:</strong> {$data['subject']} <br /> <strong>E-mail відправника:</strong> {$data['email']} <br /> <strong>Повідомлення:</strong> {$data['text']}";
                
                //Відправляємо повідомлення
                mail($admin_email->value, $subject, $message, $headers);
                
                
                //$email = Email::factory($data['subject'], $data['text'])
//                    ->to($data['email'], $data['name'])
//                    ->from($admin_email->value, $site_name->value)
//                    ->send();
                $ses_ok = 'Ваше повідомлення відправлено. Якщо воно потребує відповіді, ми зв\'яжемося з вами найближчим часом.';
                $this->session->set('message_send', $ses_ok); //Записуємо сесію
                $this->request->redirect('page/contact');
            }
            else {
                $errors = $post->errors('captcha');
            }
        }
        $info_ok = $this->session->get('message_send');
        
        $content = View::factory('index/page/page_contact_view')
            ->bind('errors', $errors)
            ->bind('data', $data)
            ->bind('captcha', $captcha)
            ->bind('info_ok',$info_ok);
        
        $this->session->delete('message_send');
        
        // Выводим в шаблон
        $this->template->title = $page->title;
        $this->template->page_title = $page->title;
        $this->template->description = $page->description;
        $this->template->keywords = $page->keywords;
        $this->template->block_content = array($page->content, $content);
    }
    
    public function action_legaladvice() {
        $captcha = Captcha::instance();
        
        $page = ORM::factory('page')->where('alias', '=', 'legaladvice')->find();
        $ip = $_SERVER['REMOTE_ADDR'];
        $legalAdvice = new Model_LegalAdvice();
        $answers = $legalAdvice->getLegalAdvice($ip);
        if (isset($_POST['send'])) {
            
            $post = Validation::factory($_POST);
            
            $post->rule('first_name','not_empty');
            $post->rule('last_name','not_empty');
            $post->rule('middle_name','not_empty');
            $post->rule('email','not_empty');
            $post->rule('email','email');
            $post->rule('birthday_date','not_empty');
            $post->rule('phone','numeric');
            $post->rule('captcha','not_empty');
            $post->rule('captcha','Captcha::valid');
            $post->rule('address', 'not_empty');
            $post->rule('question', 'not_empty');
            
            $post->label('first_name', 'Прізвище');
            $post->label('last_name', 'Ім\'я');
            $post->label('middle_name', 'По батькові');
            $post->label('email', 'E-mail');
            $post->label('birthday_date', 'Рік народження');
            $post->label('phone', 'Контактний телефон');
            $post->label('address', 'Місце проживання');
            $post->label('question', 'Питання');
            $post->label('captcha', 'Каптча');
            
            $data = Arr::extract($_POST, array('first_name', 'last_name', 'middle_name', 'email', 'birthday_date','phone', 'address', 'question', 'captcha'));
            $data = Security::xss_clean($data);
            
            if($post->check()) {
                $legaladvice = ORM::factory('legaladvice');
                $legaladvice->values($data);
                $legaladvice->date = date ("Y-m-d");
                $legaladvice->save();
                
                $admin_email = ORM::factory('setting',4);
                
                $subject = "=?windows-1251?B?".base64_encode(iconv("UTF-8", "windows-1251", 'Юридична консультація'))."?=";
                $headers = "Content-type: text/html; charset=UTF-8 \r\n";
                $headers .= "From: <$admin_email->value>\r\n"; 
                $message = "<strong>Написав(ла):</strong> {$data['first_name']} {$data['last_name']} {$data['middle_name']}
                            <br /> <strong>Тема:</strong> Юридична консультація <br /> <strong>E-mail відправника:</strong> {$data['email']} <br />
                            <strong>Повідомлення:</strong> {$data['question']}";
                //Відправляємо повідомлення
                mail($admin_email->value, $subject, $message, $headers);
                
                $ses_ok = 'Ваше запитання відправлено. В найближчий час на нього буде дана відповідь.';
                $this->session->set('message_send', $ses_ok); //Записуємо сесію
                $this->request->redirect('page/legaladvice#top');
            }
            else {
                
                $errors = $post->errors('captcha');
            }
        }
        $info_ok = $this->session->get('message_send');
        
        $content = View::factory('index/page/page_legaladvice_view')
            ->bind('answers',$answers)
            ->bind('errors', $errors)
            ->bind('data', $data)
            ->bind('captcha', $captcha)
            ->bind('info_ok',$info_ok);
        
        $this->session->delete('message_send');
        
        // Выводим в шаблон
        $this->template->title = $page->title;
        $this->template->page_title = $page->title;
        $this->template->description = $page->description;
        $this->template->keywords = $page->keywords;
        $this->template->block_content = array($page->content, $content);    
        
        
    }
}