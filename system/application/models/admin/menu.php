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
            array('href'=>'goods', 'name'=>'Товары'),
            array('href'=>'news', 'name'=>'Новости'),
            array('href'=>'text', 'name'=>'Тексты'),
            array('href'=>'objects', 'name'=>'Объекты'),
            array('href'=>'logout', 'name'=>'Выход'),
        );
    }
}

?>
