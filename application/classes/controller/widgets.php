<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Базовий клас віджетів
 */
class Controller_Widgets extends Controller_Template {

    public function  before() {
         parent::before();

        if(Request::current()->is_initial()) {
            $this->auto_render = FALSE;
            throw new HTTP_Exception_404('Сторінка не знайдена');
            return;
        }
    }
}