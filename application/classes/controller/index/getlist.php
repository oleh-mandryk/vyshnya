<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Робота з Ajax
 */
class Controller_Index_Getlist extends Controller {

    public function action_index() {
    }
    
    public function action_setNewLegalAdviceVote() {
        $getList = new Model_Getlist();
        $ip_add = $_SERVER['REMOTE_ADDR'];
        $current_date = date("Y-m-d");
        $getList->setNewLegalAdviceVote($ip_add, $current_date);
    }
}