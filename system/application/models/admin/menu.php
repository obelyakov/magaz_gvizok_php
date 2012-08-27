<?php

class menu extends Model {

    function menu()
    {
        parent::Model();
    }

    function get_menu()
    {
        return array(array('href'=>'seria', 'name'=>'Серии'),
            array('href'=>'tovcat', 'name'=>'Товарные категории'),
            array('href'=>'logout', 'name'=>'Выход'));
    }
}

?>
