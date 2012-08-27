<?php

/**
 *  Работа с СЕРИЯМИ Админский класс
 *
 */
class Seria extends Controller {

    public $is_login;
    public $menu;
    public $seria = array();
    public $shtml = '';
    public $slev = 0;
    public $add_but;
    public $del_but;

    function Seria()
    {
        parent::Controller();
        $this->load->model('admin/menu', 'menu_dao');
        $this->load->model('admin/auth', 'auth_dao');
        $this->load->model('admin/seria_model', 'seria_dao');
        $this->load->model('admin/tovcat_model', 'tovcat_dao');

        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('html');
        
        $this->add_but = img('/adminnn/images/ico/add16.png');
        $this->del_but = img('/adminnn/images/ico/remove16.png');

        if($this->auth_dao->get_user_role() == 'admin') $this->is_login = 1;
        if(!$this->is_login)
        {
            header('Location: /admin/');
            die();
        }

        $this->menu = $this->menu_dao->get_menu();
        
        //построение дерева серий
        //$this->seria_dao->_get_tree(0);// @TODO можно убрать, вызывается автоматически если переменная дерева пуста.
    }


    function index($mess = '')
    {
        if(!$this->is_login)
        {
            header('Location: /admin/');
            die();
        }

        #var_dump($this->shtml);
        #var_dump($this->seria);

        $data = array(
            'container' => 'seria',
            'menu' => $this->menu,
            'shtml' => $this->seria_dao->get_tree_value(0, array('add', 'del')),
            'mess' => $mess,
            'level0_addbut' => $this->seria_dao->seria_dao->_add_but(0)
        );

        $this->load->view('admin/other', $data);
    }
    
    /* обертка для передачи сообщений*/
    function mess($i, $method = '')
    {
        $mess = '';
        switch ($i){
            case 1: $mess = 'Нельзя удалить т.к. есть вложенные серии. Сначала удалите все внутри';
                    $this->index($mess);
            case 2: $mess = 'Серия отредактированна. Данные сохранены'; return $mess;
            case 3: $mess = 'Серия удалена.';
                    $this->index($mess);
            case 4: $mess = 'Серия добавлена.';
                    $this->index($mess);
                        
        }
        
        
    }
    
    /** рекурсивный обход дерева серий
     *
     * @param int $id id с которого идти вниз по дереву
     * @return string сформированная строка-путь
     */
    function _get_seria_path($id)
    {
        $item = $this->seria_dao->get_item($id);
        if(!$item) return 'Корень';
        if($item->parent_id != 0){
            return $this->_get_seria_path($item->parent_id).' -> '.$item->sname;
        }else{
            return $item->sname;
        }
    }




    /** Страница редактирования
     * 
     */
    function edit($id)
    {
        if(!$id) return;
        $item = $this->seria_dao->get_item($id);
        $path = $this->_get_seria_path($id);
        $tc = $this->tovcat_dao->get_tovcat();
        
        if($this->input->post('edit_seria'))
        {// нажали редактировать серию
            $this->seria_dao->set_item($this->input->post('id'), array('sname'=>$this->input->post('sname'), 
                                                                   'id_tovcat'=>$this->input->post('id_tovcat') ));
            redirect('/admin/seria/edit/'.$this->input->post('id').'/mess/2');
            exit;
        }

        if($this->uri->segment(5) == 'mess') $mess = $this->mess(2);
        $data = array(
            'container' => 'seria',
            'menu' => $this->menu,
            'shtml' => $this->seria_dao->get_tree_value(0),
            'item' => $item,
            'path' => $path,
            'mode' => 'edit',
            'wzn' => 'Редактирование серии',
            'level0_addbut' => $this->seria_dao->_add_but(0),
            'tc' => $tc,
            'mess' => isset($mess) ? $mess : ''
        );

        $this->load->view('admin/other', $data);
    }
    
    /** Страница добавления новой 
     * 
     */
    function add($id)
    {
        $path = $this->_get_seria_path($id);
        $tc = $this->tovcat_dao->get_tovcat();
        
        if($this->input->post('edit_seria'))
        {// нажали редактировать серию
            $this->seria_dao->add_item(array('parent_id'=>$id , 'sname'=>$this->input->post('sname'), 
                                                                   'id_tovcat'=>$this->input->post('id_tovcat') ));
            redirect('/admin/seria/mess/4');
            exit;
        }
        
        
        $data = array(
            'container' => 'seria',
            'menu' => $this->menu,
            'shtml' => $this->seria_dao->get_tree_value(0),
            'path' => $path,
            'mode' => 'edit',
            'wzn' => 'Добавление серии',
            'tc' => $tc,
            'level0_addbut' => $this->seria_dao->_add_but(0)
        );

        $this->load->view('admin/other', $data);        
    }
    
    /*
     * удаление позиции (если нет под ним никого)
     */
    function del($id)
    {
        if(!$id) return;
        if($this->seria_dao->get_items(array('parent_id' => $id))){
            redirect('/admin/seria/mess/1');//ошибка с кодом 1
            die();
        }
        // удаление
        $this->seria_dao->del_item($id);
        redirect('/admin/seria/mess/3');
        die();
        
    }
    
    

}

?>
