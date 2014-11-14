<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Віджет "Хлібні крихти"
 */
class Controller_Widgets_Breadcrumb extends Controller_Widgets {
   
    public $template = 'widgets/breadcrumb_view';

    public function action_index() {
        
        $select1 = Request::initial()->controller();
        $select3 = Request::initial()->action();
        $select2 = Request::initial()->param('id');
        $select = Request::initial()->param('page_alias');
        
        
        if ($select == NULL) {
            $select = Request::initial()->action();
        }
        
        $breadcrumb_it = array();
        
        $menu_main = new Model_Breadcrumb();
        
        switch ($select1) {
            //якщо контроллер "News"
            case 'news':
                if ($select2 != null) {
                    $breadcrumb_it = $menu_main->selectBreadcrumbNewsOne($select2);
                }
                else {
                    $id_cont = 'Новини';
                    $breadcrumb_it = $menu_main->selectBreadcrumbCont($select1, $id_cont);
                }
            break;
            
            //якщо контроллер "Poll"
            case 'poll':
                $id_cont = 'Голосування';
                $breadcrumb_it = $menu_main->selectBreadcrumbCont($select1, $id_cont);
            break;
            
            //якщо контроллер "Materialsteachers"
            case 'materialsteachers':
                $id_cont = 'Методичні матеріали викладачам';
                $breadcrumb_it = $menu_main->selectBreadcrumbCont($select1, $id_cont);
            break;
            
            //якщо контроллер "Materialsstudents"
            case 'materialsstudents':
                $id_cont = 'Методичні матеріали студентам стаціонару';
                $breadcrumb_it = $menu_main->selectBreadcrumbCont($select1, $id_cont);
            break;
            
            //якщо контроллер "Materialsstudentszaoch"
            case 'materialsstudentszaoch':
                $id_cont = 'Методичні матеріали студентам заочникам';
                $breadcrumb_it = $menu_main->selectBreadcrumbCont($select1, $id_cont);
            break;
            
            //якщо контроллер "Materialsstudentsadd"
            case 'materialsstudentsadd':
                $id_cont = 'Методичні матеріали студентам стаціонару';
                $breadcrumb_it = $menu_main->selectBreadcrumbCont($select1, $id_cont);
            break;
            
            //якщо контроллер "Materialsstudentszaochadd"
            case 'materialsstudentszaochadd':
                $id_cont = 'Методичні матеріали студентам заочникам';
                $breadcrumb_it = $menu_main->selectBreadcrumbCont($select1, $id_cont);
            break;
            
            //якщо контроллер "Search"
            case 'search':
                $id_cont = 'Пошук';
                $breadcrumb_it = $menu_main->selectBreadcrumbCont($select1, $id_cont);
            break;
            
            //якщо контроллер "Photogallery"
            case 'photogallery':
                $id_cont = 'Фотогалерея';
                $breadcrumb_it = $menu_main->selectBreadcrumbCont($select1, $id_cont);
            break;
            
            //якщо контроллер "Sitemap"
            case 'sitemap':
                $id_cont = 'Карта сайту';
                $breadcrumb_it = $menu_main->selectBreadcrumbCont($select1, $id_cont);
            break;
            
            //якщо контроллер "Schedulesta"
            case 'schedulesta':
                $id_cont = 'Розклад студентам стаціонару';
                $breadcrumb_it = $menu_main->selectBreadcrumbCont($select1, $id_cont);
            break;
            
            //якщо контроллер "Schedulestateachers"
            case 'schedulestateachers':
                $id_cont = 'Розклад викладачам стаціонару';
                $breadcrumb_it = $menu_main->selectBreadcrumbCont($select1, $id_cont);
            break;
            
            //якщо контроллер "Schedulezaoch"
            case 'schedulezaoch':
                $id_cont = 'Розклад студентам заочникам';
                $breadcrumb_it = $menu_main->selectBreadcrumbCont($select1, $id_cont);
            break;
            
            //якщо контроллер "Schedulezaochteachers"
            case 'schedulezaochteachers':
                $id_cont = 'Розклад викладачам заочників';
                $breadcrumb_it = $menu_main->selectBreadcrumbCont($select1, $id_cont);
            break;
            
            //якщо контроллер "Schedulechanges"
            case 'schedulechanges':
                $id_cont = 'Оновлення змін до розкладу';
                $breadcrumb_it = $menu_main->selectBreadcrumbCont($select1, $id_cont);
            break;
            
            //якщо контроллер "legaladvice"
            case 'legaladvice':
                $id_cont = 'Юридична консультація';
                $breadcrumb_it = $menu_main->selectBreadcrumbCont($select1, $id_cont);
            break;
            
            //якщо контроллер "Auth"
            case 'auth':
                switch($select3) {
                    case 'register':
                        $id_cont = 'Реєстрація';
                        $breadcrumb_it = $menu_main->selectBreadcrumbCont($select3, $id_cont);
                    break;
                    
                    case 'login':
                        $id_cont = 'Авторизація';
                        $breadcrumb_it = $menu_main->selectBreadcrumbCont($select3, $id_cont);
                    break;
                    
                    case 'restore_password':
                        $id_cont = 'Відновлення паролю';
                        $breadcrumb_it = $menu_main->selectBreadcrumbCont($select3, $id_cont);
                    break;
                    
                    case 'logout':
                        $id_cont = 'Вихід';
                        $breadcrumb_it = $menu_main->selectBreadcrumbCont($select3, $id_cont);
                    break;
                    
                    default:
                        $breadcrumb_it = $menu_main->selectBreadcrumb($select);
                    break;
                }
            break;
            
            //якщо контроллер "Auth"
            case 'account':
                switch($select3) {
                    case 'index':
                        $id_cont = 'Профіль';
                        $breadcrumb_it = $menu_main->selectBreadcrumbCont($select3, $id_cont);
                    break;
                    
                    case 'profile':
                        $id_cont = 'Редагування профілю';
                        $breadcrumb_it = $menu_main->selectBreadcrumbCont($select3, $id_cont);
                    break;
                }
            break;
            
            default:
                $breadcrumb_it = $menu_main->selectBreadcrumb($select);
            break;
        }
        $this->template->breadcrumb_it  = $breadcrumb_it ;
    }
}