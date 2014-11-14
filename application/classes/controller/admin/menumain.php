<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Головне меню
 */
class Controller_Admin_Menumain extends Controller_Admin {

    public function before() {
        parent::before();

        $this->template->scripts[] = 'media/js/select.js';
        $this->template->scripts[] = 'media/js/select_add.js';
            
        //Вивід в шаблон
        $this->template->submenu = Widget::load('menumenu');
        $this->template->page_title = 'Головне меню';
        $this->template->title = 'Головне меню';
    }

    public function action_index() {
    
        $menu_main = ORM::factory('menumain')->fulltree();
        
        $info_ok = $this->session->get('message_admin');
        
        $content = View::factory('admin/menu_main/menu_main_index_view', array(
            'menu_main' => $menu_main,
            'info_ok' => $info_ok,
        ));
        
        $this->session->delete('message_admin');

        //Вивід в шаблон
        $this->template->block_main_content = array($content);
    }
    
    // Додавання головного пункту
    public function action_add_main() {
        
        //Отримання всіх сторінок
        $pages_all = ORM::factory('page')
            ->where('alias','!=', 'index')
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();

        $pages = array();
        foreach ($pages_all as $page) {
            $pages[$page->id] = $page->title;
        }
        
        if (isset($_POST['submit'])) {
            
            $data = Arr::extract($_POST, array('title', 'page_id'));
            $menu_main = ORM::factory('menumain');
            $menu_main->values($data);

            try {
                $menu_main ->make_root();
                
                $ses_ok = Kohana::message('message', 'add');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                
                $this->request->redirect('admin/menumain');
            }
            catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }

        $content = View::factory('admin/menu_main/menu_main_add_main_view')
            ->bind('errors', $errors)
            ->bind('data', $data)
            ->bind('pages',$pages);

        //Вивід в шаблон
        $this->template->page_title .= ' :: Додати';
        $this->template->title .= ' :: Додати';
        $this->template->block_main_content = array($content);
    }
    
    //Додавання підпункту до головного пункту
    public function action_add() {
        
        //Отримання всіх сторінок
        $pages_all = ORM::factory('page')
            ->where('alias','!=', 'index')
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();

        $pages = array();
        foreach ($pages_all as $page){
            $pages[$page->id] = $page->title;
        }
        
        //Отримання всіх головних пунктів
        $menu_main_all = ORM::factory('menumain')
            ->where('lvl','=', 1)
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();

        $menu_mains = array();
        foreach ($menu_main_all as $menu){
            $menu_mains[$menu->id] = $menu->title;
        }
        
        //Отримання всіх підпунктів
        $menu_pid_all = ORM::factory('menumain')
            ->where('lvl','=', 2)
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();
        
        if (isset($_POST['submit'])) {
            $data = Arr::extract($_POST, array('title', 'page_id', 'menu_id', 'pid_id'));
            $menu_main = ORM::factory('menumain');
            $menu_main->values($data);

            try {
                switch ($_POST['way_id']) {
                    case 1:
                        $menu_main ->insert_as_last_child($_POST['menu_id']);
                    break;
                        
                    case 2:
                        $menu_main ->insert_as_first_child($_POST['menu_id']);
                    break;
                        
                    case 3:
                        if (isset ($_POST['menu_pid'])) {
                            $menu_main ->insert_as_next_sibling($_POST['menu_pid']);
                        }
                        else {
                            $menu_main ->insert_as_last_child($_POST['menu_id']);
                        }
                    break;
                }
                
                $ses_ok = Kohana::message('message', 'add');
                $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                $this->request->redirect('admin/menumain');
            }
            catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }
        
        $content = View::factory('admin/menu_main/menu_main_add_view')
            ->bind('errors', $errors)
            ->bind('data', $data)
            ->bind('menu_mains', $menu_mains)
            ->bind('menu_pid_all', $menu_pid_all)
            ->bind('pages',$pages);
        
        //Вивід в шаблон
        $this->template->page_title .= ' :: Додати';
        $this->template->title .= ' :: Додати';
        $this->template->block_main_content = array($content);
    }
    
    public function action_edit() {
        
        $id = (int) $this->request->param('id');
        if(!$id) {
            $this->request->redirect('admin/menumain');
        }
        //Отримання всіх сторінок
        $pages_all = ORM::factory('page')
            ->where('alias','!=', 'index')
            ->order_by('title','ASC')
            ->find_all()
            ->as_array();

        $pages = array();
            foreach ($pages_all as $page){
                $pages[$page->id] = $page->title;
        }
        
        $menu_main = ORM::factory('menumain', $id);
        $data = $menu_main->as_array();
            
        switch($data['lvl']) {
            
            //Якщо головний пункт
            case 1:
                // Редагування
                if (isset($_POST['submit'])) {
                    
                    $data = Arr::extract($_POST, array('title', 'page_id'));
                    $menu_main->values($data);
        
                    try {
                        $menu_main->save();
                            
                        $ses_ok = Kohana::message('message', 'edit');
                        $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                            
                        $this->request->redirect('admin/menumain');
                    }
                    catch (ORM_Validation_Exception $e) {
                        $errors = $e->errors('validation');
                    }
                } 
    
                $content = View::factory('admin/menu_main/menu_main_edit_main_view')
                    ->bind('id', $id)
                    ->bind('errors', $errors)
                    ->bind('data', $data)
                    ->bind('pages',$pages);
            
            break;
            
            //Якщо підпункт головного пункту
            default:
                $men = ORM::factory('menumain')->where('id','=',$id)->find();
                $men_got = $menu_main->where('id','=', $men->parent_id)->as_array();
                $data['menu_id'] = $men_got['parent_id'];
                
                //Отримання всіх головних пунктів
                $menu_main_all = ORM::factory('menumain')
                    ->where('id','=', $data['menu_id'])
                    ->find_all()
                    ->as_array();

                $menu_mains = array();
                foreach ($menu_main_all as $menu){
                    $menu_mains[$menu->id] = $menu->title;
                }
                
                // Редагування
                if (isset($_POST['submit'])) {
                    
                    $data = Arr::extract($_POST, array('title', 'page_id', 'menu_id'));
                    $menu_main->values($data);
                    
                    try {
                        $menu_main->save();
                            
                        $ses_ok = Kohana::message('message', 'edit');
                        $this->session->set('message_admin', $ses_ok); //Записуємо сесію
                            
                        $this->request->redirect('admin/menumain');
                    }
                    catch (ORM_Validation_Exception $e) {
                        $errors = $e->errors('validation');
                    }
                }
    
                $content = View::factory('admin/menu_main/menu_main_edit_view')
                    ->bind('id', $id)
                    ->bind('errors', $errors)
                    ->bind('data', $data)
                    ->bind('menu_mains', $menu_mains)
                    ->bind('pages',$pages);
            break;
        }
        
        //Вивід в шаблон
        $this->template->page_title .= ' :: Редагування';
        $this->template->title .= ' :: Редагування';
        $this->template->block_main_content = array($content);
    }
    
    public function action_delete() {
        $id = (int) $this->request->param('id');
        $menu_main = ORM::factory('menumain', $id);
        
        if(!$menu_main->loaded()){
            $this->request->redirect('admin/menumain');
        }
        
        $menu_main->delete();
        
        $ses_ok = Kohana::message('message', 'delete');
        $this->session->set('message_admin', $ses_ok); //Записуємо сесію
        
        $this->request->redirect('admin/menumain');
    }
}