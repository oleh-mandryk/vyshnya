<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Личный кабинет
 */
class Controller_Index_Schedulechanges extends Controller_Index {

    public function before(){
        parent::before();
        
        $this->template->scripts[] = 'media/js/jquery-1.6.2.min.js';
        $this->template->scripts[] = 'media/js/jquery.MultiFile.pack.js';
        $this->template->scripts[] = 'media/js/upload_file.js';
        
        $ses_url = Request::initial()->url();
        $this->session->delete('admin_red');
        $this->session->set('admin_red', $ses_url); //Записуємо сесію
        
        if ((!$this->auth->logged_in('miniadmin'))&&(!$this->auth->logged_in('admin'))) {
            $this->request->redirect('login');
        }
    }
    
    public function action_index() {
        
        $auth = Auth::instance();
        
        if (isset($_POST['submit'])) {
            
            $validate = Validation::factory($_FILES);
                $validate->rule('url_file', 'Upload::valid');
                $validate->rule('url_file', 'Upload::type', array(':value', array('doc')));
                //$validate->rule('url_file', 'Upload::size', array('1M'));
		$validate->rule('url_file', 'Upload::size', array(':value', '2M'));
		//$validate->rule('url_file', 'Upload::size', array(':value', '1M'));
            
            if ($validate->check()) {
                
                $useful = new Model_Useful();
                
                $directory = 'media/files/schedule';
                
                //Задання імені файлу
                $filename = $useful->_name_file();
                
                Upload::save($_FILES['url_file'], $filename, $directory, 0777);
                
                $ses_ok = Kohana::message('message', 'schedulechanges');
                $this->session->set('message_schedule', $ses_ok); //Записуємо сесію
                    
                $this->request->redirect('schedulechanges');
            }
            else {
                $errors = $validate->errors('upload');
            }
        }
        
        $info_ok = $this->session->get('message_schedule'); 
        
        $content = View::factory('index/schedule_changes/schedule_changes_view')
                        ->bind('user', $this->user)
                        ->bind('errors', $errors)
                        ->bind('info_ok', $info_ok);
                        
        $this->session->delete('message_schedule');

        // Выводим в шаблон
        $this->template->title = 'Оновлення змін до розкладу';
        $this->template->page_title = 'Оновлення змін до розкладу';
        $this->template->block_content = array($content);
    }
}