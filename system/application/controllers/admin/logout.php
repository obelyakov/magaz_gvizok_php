<?php

/**
 *  ВЫХОД Админский класс
 *
 */
class Logout extends Controller {

    public $is_login;
    public $menu;

    function Logout()
    {
        parent::Controller();
        $this->load->model('admin/menu', 'menu_dao');
        $this->load->model('admin/auth', 'auth_dao');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');

        if($this->auth_dao->get_user_role() == 'admin') $this->is_login = 1;

        $this->menu = $this->menu_dao->get_menu();
    }


    function index()
    {
    // разлогиниться
        $this->session->unset_userdata('userlogin');
        $this->session->unset_userdata('name');
        redirect('admin');
    }




}

?>
