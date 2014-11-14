<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Контроллер для обробки помилок
 */
class Controller_Error extends Controller_Base {
 
    public $template;
 
    public function before() {
        parent::before();
 
        //Отримуємо статус помилки
        $status = (int) $this->request->action();
 
        // призначаємо шаблон	
        $this->template = View::factory('errors/' . $status);
 
        // Отримуємо повідомлення про помилку
        if (Request::$initial !== Request::$current) {
            $message = rawurldecode($this->request->param('message'));
 
            if ($message) {
                $this->template->message = $message;
            }
        }
        else {
            $this->request->action(404);
        }
        $this->response->status($status);
    }
 
 
    public function action_404() {
        $this->template->title = 'Файл не знайдено';
    }
 
    public function action_503() {
        $this->template->title = 'Послуга тимчасово недоступна';
    }
 
    public function action_500() {
        $this->template->title = 'Внутрішня помилка сервера';
    }
}