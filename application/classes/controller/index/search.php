<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Index_Search extends Controller_Index {

    public function before() {
        parent::before();
        
        $ses_url = Request::initial()->url();
        $this->session->delete('admin_red');
        $this->session->set('admin_red', $ses_url); //Записуємо сесію
        
        $this->template->styles[] = 'media/css/search_results.css';
    }
    
    public function action_index()
    {
        $search_result = new Model_Search();
            
        //Якщо натуснута кнопка "Пошук"
        if (isset($_POST['search_go']))
        {
            $post = Validation::factory($_POST);
            $post->rule('search','not_empty');
            $post->rule('search','min_length',array(':value','3'));
            $post->rule('search','max_length',array(':value','50'));
            $post->label('search', 'Поле пошуку');
                        
            if($post->check())
            {
                $search = $_POST['search'];
                
                $search = Security::xss_clean($search);
                
                $search = UTF8::trim($search);
                
                //Конвертуємо спеціальні символи в html-сутності, щоб введений запит не містив розмітки html
                $search = htmlspecialchars($search);
                
                //Валідація пройдена успішно для пошукового запиту       
                $val_passed = 'yes'; 
                
                //Записуємо сесію
                $this->session->set('search_query', $search); //Записуємо сесію
                $this->session->set('val_passed', $val_passed); //Записуємо сесію
                
                $ses_search_ok = $this->session->get('search_query');
                
                $p_search_results = $search_result->resultsSearch($ses_search_ok);
                $pagination = $p_search_results['pagination'];
                
                //Якщо масив пустий
                if (empty ($p_search_results))
                {                      
                    $info_vote = 'Інформація по Вашому запиту на знайдена!';
                    $info_vote_id = 'error';
                    $p_search_results = null;
                }
            }
            else
            {
                $errors = $post->errors('validation');
            }
        }
        //Якщо ненатиснута кнопка "Пошук"
        else
        {
            if ($this->session->get('val_passed') === 'yes')
            {
                $ses_search_ok = $this->session->get('search_query');
                
                $p_search_results = $search_result->resultsSearch($ses_search_ok);
                $pagination = $p_search_results['pagination'];                
                
                //Якщо масив пустий
                if (empty ($p_search_results))
                {                      
                    $info_vote = 'Інформація по Вашому запиту на знайдена!';
                    $info_vote_id = 'error';
                    $p_search_results = null;
                }
            }
            else
            {
                $info_vote = 'Неправильні параметри пошуку!';
                $info_vote_id = 'error';
                $p_search_results = null;
            }
        }
        
        $content = View::factory('index/search/search_view')
            ->bind('errors', $errors)
            ->bind('ses_search_ok',$ses_search_ok)
            ->bind('p_search_results', $p_search_results)
            ->bind('pagination', $pagination)
            ->bind('info_vote', $info_vote)
            ->bind('info_vote_id', $info_vote_id);
        
        // Виводимо в шаблон
        $this->template->title = 'Результати пошуку';
        $this->template->page_title = 'Результати пошуку';
        $this->template->block_content = array($content);
    }
}