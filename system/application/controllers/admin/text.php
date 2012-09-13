<?php

/**
 *  КОНТРОЛЛЕР Работа с текстами
 *  @property goods_model $goods_dao
 */
class Text extends Controller {

    public $is_login;
    public $menu;
    public $seria = array();
    public $shtml = '';
    public $slev = 0;
    public $add_but;
    public $del_but;

    function Text   ()
    {
        parent::Controller();
        $this->load->helper(array('form', 'url'));
        $this->load->model('admin/common_model', 'common_dao');
        $this->load->model('admin/menu', 'menu_dao');
        $this->load->model('admin/auth', 'auth_dao');
        $this->load->library('session');
        if($this->auth_dao->get_user_role() == 'admin') $this->is_login = 1;
        if(!$this->is_login)
        {
            header('Location: /admin/');
            die();
        }


        $this->menu = $this->menu_dao->get_menu();
        //$this->output->enable_profiler(TRUE);
        $this->rules['title'] = "required|min_length[5]|max_length[254]";
        $this->rules['text'] = "required|min_length[25]|max_length[5000]";

    }

    function index()
    {
        $list = $this->common_dao->get_text_list();
        $data = array(
            'container' => 'text/news',
            'menu' => $this->menu,
            'list' => $list,
            'act_ok'=>  $this->uri->segment(4),
        );
        $this->load->view('admin/other', $data);
    }

    function edit($id)
    {
        $item = $this->common_dao->get_one_text($id);
        $data = array(
            'container' => 'text/edit',
            'menu' => $this->menu,
            'item' => $item[0],
        );
        $this->load->library('validation');
        $this->load->helper(array('form', 'url'));
        $this->validation->set_rules($this->rules);
        if ($this->validation->run() == FALSE)
        {
            $this->load->view('admin/other', $data);
        }else{
            $this->common_dao->text_edit($id, array('title'=>  $this->input->post('title'),
                'text'=>$this->input->post('text')));
            $data['mess'] = 1;
            $this->load->view('admin/other', $data);
        }
    }

    function add()
    {
        $data = array(
            'container' => 'text/add',
            'menu' => $this->menu,
        );
        $this->load->helper(array('form', 'url'));
        $this->load->library('validation');
        $this->validation->set_rules($this->rules);
        if ($this->validation->run() == FALSE)
        {
            $data['container'] = 'text/add';
        }
        else
        {
            # add news
            $this->common_dao->text_add(array(
                    'date'=>date('Y-m-d H:i:s'),
                    'title'=>$this->input->post('title'),
                    'text'=>$this->input->post('text'))
            );
            redirect('/admin/text/index/add_ok');
        }

        $this->load->view('admin/other', $data);
    }

    function del($id)
    {
        $this->common_dao->text_del($id);
        redirect('/admin/text/index/del_ok');
    }


}



?>