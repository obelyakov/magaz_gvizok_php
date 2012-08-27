<?php

/**
 * Центральный Админский класс
 * 
 */
class Welcome extends Controller {

    public $is_login;
    public $menu;

    function Welcome()
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
        //работает форма авторизации
        if($_POST)
        {
            if($this->input->post('login')=='admin' && $this->input->post('pass')=='123')
            {
                $this->session->set_userdata(array(
                    'userlogin'=>1, 
                    'name'=>$this->input->post('login')
                        ));
                redirect('admin');
            }
        }

        // редирект на первый пункт меню
        if($this->session->userdata('userlogin')==1)
        {
            redirect('admin/'.$this->menu[0]['href']);
        }
        else
        {
            $data = array(
                'container' => 'auth'
            );
            $this->load->view('admin/other', $data);

        }

    }

    // разлогиниться
    function logout()
    {
        $this->session->unset_userdata('userlogin');
        redirect('admin');
    }

    
}

?>
