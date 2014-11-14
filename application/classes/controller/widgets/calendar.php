<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Віджет "Календар
 */
class Controller_Widgets_Calendar extends Controller_Widgets {
   
    public $template = 'widgets/calendar_view';
    
    public function action_index() {
        $calendar = new Calendar(Arr::get($_GET, 'month', date('m')), Arr::get($_GET, 'year', date('Y')));
        
        $this->template->calendar = $calendar;
    }
}