<?php

/**
 */
class Welcome extends Controller {

    public $is_login;
    public $menu;
    public $seria = array();
    public $shtml = '';
    public $slev = 0;
    public $add_but;
    public $del_but;

    function Welcome()
    {
        parent::Controller();
        $this->load->helper(array('form', 'url'));
        $this->load->model('admin/common_model', 'common_dao');
        $this->load->model('admin/menu', 'menu_dao');
        $this->load->model('admin/auth', 'auth_dao');
        $this->load->library('session');
    }

    function index()
    {
        $item = $this->common_dao->get_one_text(3);
        $our_obj = $this->common_dao->get_objects_list();
        $data = array(
            'text' => $item[0],
            'container' => 'news/news',
            'our_obj' =>  array_slice($our_obj, 0, 5),
        );
        $this->load->view('main', $data);
    }




}



?>