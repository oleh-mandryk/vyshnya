<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Віджет "Голосування"
 */
class Controller_Widgets_Polloptionsquestions extends Controller_Widgets {
   
    public $template = 'widgets/polloptionsquestions_view';

    public function action_index() {
        $pollquestion = new Model_Pollquestion();
        $polloption = new Model_Polloption();
        
        $ques = $pollquestion->showQues();
        $options = $polloption->showOptions();
        
        $this->template->ques = $ques;
        $this->template->options = $options;
    }
}