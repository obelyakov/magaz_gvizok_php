<?php

/**
 *  Работа с Товарными категориями Админский класс
 *
 */
class Tovcat extends Controller {

    public $is_login;
    public $menu;
    public $seria = array();
    public $shtml = '';
    public $slev = 0;
    public $add_but;
    public $del_but;

    function Tovcat()
    {
        parent::Controller();
        $this->load->model('admin/menu', 'menu_dao');
        $this->load->model('admin/auth', 'auth_dao');
        $this->load->model('admin/tovcat_model', 'tovcat_dao');

        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('html');
        

        if($this->auth_dao->get_user_role() == 'admin') $this->is_login = 1;
        if(!$this->is_login)
        {
            header('Location: /admin/');
            die();
        }

        $this->menu = $this->menu_dao->get_menu();
        
    }

    function index()
    {
        $items = $this->tovcat_dao->get_tovcat();
        
        
        $data = array(
            'container' => 'tovcat',
            'menu' => $this->menu,
            'items' => $items
        );

        $this->load->view('admin/other', $data);
        
    }
    
/*=========================================================================*/    
    
    /* forma добавление*/
    function add()
    {
        $data = array(
            'container' => 'tovcat_edit',
            'menu' => $this->menu,
        );

        $this->load->view('admin/other', $data);
    }

/*=========================================================================*/    

    
    /* forma редактирования*/
    function edit($id)
    { 
        if($this->uri->segment(5) == '1') $mess = 'Информация добавлена'; 
            elseif($this->uri->segment(5) == '2') $mess = 'Информация изменена'; 
                else $mess = '';
        $tc = $this->tovcat_dao->get_tovcat(array('id_tovcat'=>$id));
        if(!$tc) return FALSE;
        $tcf = $this->tovcat_dao->get_tc_fields($id);
        $data = array(
            'container' => 'tovcat_edit',
            'menu' => $this->menu,
            'tc' => $tc,
            'tcf' => $tcf,
            'id' => $id,
            'mess' => $mess
        );

        $this->load->view('admin/other', $data);
    }
    
/*=========================================================================*/    

    /* отработка формы добавление/редактирование*/
    function addedit()
    {
        if(count($_POST) && isset($_POST['tc_name']))
        {
            $data = array('id_filedtc' => $this->input->post('id_filedtc'),
                          'tc_name' => $this->input->post('tc_name'),
                          'tc_descr' => $this->input->post('tc_descr'),
                          'name' => $this->input->post('name'),
                          'ftype' => $this->input->post('ftype'),
                          'size' => $this->input->post('size'),
                          'order' => $this->input->post('order'),
                          'onmain' => $this->input->post('onmain'),
                          'descr' => $this->input->post('descr'),
                );
            if(isset($_POST['id']) && $_POST['id']){
                $data['id_tovcat'] = $_POST['id'];
                $mess = 2;
            }else $mess = 1;
            $id = $this->tovcat_dao->addedit_tovcat($data);
        }
        redirect('/admin/tovcat/edit/'.$id.'/'.$mess);
    }
    
    
    function del_tovcat($id)
    {
        $this->tovcat_dao->del_tovcat($id);
        redirect('/admin/tovcat/');
    }
    
    
    
}

?>
