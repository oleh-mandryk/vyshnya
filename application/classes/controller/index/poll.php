<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Голосування
 */
class Controller_Index_Poll extends Controller_Index {
        
    public function before() {
        parent::before();
        
        $ses_url = Request::initial()->url();
        $this->session->delete('admin_red');
        $this->session->set('admin_red', $ses_url); //Записуємо сесію
    }
    
    public function action_index() {
        
        $pollquestion = new Model_Pollquestion();
        $polloption = new Model_Polloption();
        $pollvote = new Model_Pollvote();
        
        // Якщо натиснута кнопка результати
        if (isset($_POST['result_button'])) {
            
            $info_vote = null;
            $info_vote_id = null; 
        }
        else
        {
            if ( isset($_POST['vote_button']) AND isset($_POST['poll']) ) {
                
                $ip_add = $_SERVER['REMOTE_ADDR'];
                $ip_result = $pollvote->getIp($ip_add);
                $result_cook = Cookie::get('voted');
                
                if ( ( $result_cook == FALSE) AND ( empty($ip_result))) {
                    
                    $current_date = date("Y-m-d");
                    $poll = $_POST['poll'];
                    $pollvote->insertRecord($poll, $current_date, $ip_add);
                    Cookie::set('voted', 'voted', 300);
                    $info_vote = 'Дякуємо за Ваш Голос!';
                    $info_vote_id = 'not_error';
                }
                else
                {
                    $info_vote = 'Ви вже проголосували!';
                    $info_vote_id = 'error';
                }
            }
            else
            {
                if (isset($_POST['vote_button'])) {
                    $info_vote = 'Ваш вибір не був зроблений, будь-ласка, спробуйте ще раз!';
                    $info_vote_id = 'error'; 
                }
                else
                {
                    $info_vote = null;
                    $info_vote_id = null;
                }
                
            }
        }
        
        $ques = $pollquestion->showQues();
        $options = $polloption->showOptions();
        $count_vote = $pollvote->countVote();
        $first_vote = $pollvote->firstVote();
        $last_vote = $pollvote->lastVote();
        $results_vote = $pollvote->resultsVote();
        
        $content = View::factory('index/poll/poll_result_view', array(
                'ques' => $ques,
                'options' => $options,
                'count_vote' => $count_vote,
                'first_vote' => $first_vote,
                'last_vote' => $last_vote,
                'results_vote' => $results_vote,
                'info_vote' => $info_vote,
                'info_vote_id' => $info_vote_id,
        ));
            
        // Виводимо в шаблон
        $this->template->title = 'Результати голосування';
        $this->template->page_title = 'Результати голосування';
        $this->template->block_content = array($content);
    }
}