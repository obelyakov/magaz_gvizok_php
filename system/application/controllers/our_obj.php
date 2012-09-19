<?php
    /**
     */
class Our_obj extends Controller {

    public $is_login;
    public $menu;
    public $seria = array();
    public $shtml = '';
    public $slev = 0;
    public $add_but;
    public $del_but;

    function Our_obj()
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
        $list = $this->common_dao->get_objects_list();

        $data = array(
            'container' => 'our_obj',
            'list' => $list
        );

        $this->load->view('other', $data);
    }
}
