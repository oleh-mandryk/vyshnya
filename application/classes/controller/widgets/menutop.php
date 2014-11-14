<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Віджет "Розклад"
 */
class Controller_Widgets_Menutop extends Controller_Widgets {
    
    public $template = 'widgets/menutop_view';

    public function action_index() {
        $select1 = Request::initial()->controller();
        $select2 = Request::initial()->action();
        if ($select2 == 'index') {
            $select = $select1;
        }
        else {
            $select = $select1.'/'.$select2;
        }
        
        $menutop = array(
            'Контакти' => array('page/contact','contact.gif'),
            'Карта сайту' => array('sitemap','map.gif'),
        );
        
        // Вывод в шаблон
        $this->template->menutop = $menutop;
        $this->template->select = $select;
    }
}