<?php defined('SYSPATH') or die('No direct script access.');
/*
 * Віджет "Крилатих фраз"
 */
class Controller_Widgets_Wingedphrases extends Controller_Widgets {
    
    public $template = 'widgets/wingedphrases_view';

    public function action_index() {
        // Отримуємо всі id крилатих фраз з бази даних
        $input = ORM::factory('wingedphrase')
            ->where('publish_id', '=', 1)
            ->find_all()
            ->as_array();
        
        // Вибираємо одне випадкове значення з масиву
        $rand_keys = array_rand($input, 1);
        $id_ok = $input[$rand_keys];
        
        // Отримуємо крилату фразум з бази даних, яка відповідає згенерованому id
        $one_wingedphrases = ORM::factory('wingedphrase')
            ->where('publish_id', '=', 1)
            ->where('id', '=', $id_ok)
            ->find_all();
        $this->template->one_wingedphrases = $one_wingedphrases;
    }
}