<?php

/**
 *  КОНТРОЛЛЕР Работа с "Нашими объектами" Админский класс
 *  @property goods_model $goods_dao
 */
class Objects extends Controller {

    public $is_login;
    public $menu;
    public $seria = array();
    public $shtml = '';
    public $slev = 0;
    public $add_but;
    public $del_but;

    function Objects()
    {
        parent::Controller();
        $this->load->helper(array('form', 'url'));
        $this->load->model('admin/common_model', 'common_dao');
        $this->load->model('admin/menu', 'menu_dao');
        $this->load->model('admin/auth', 'auth_dao');
        $this->load->library('session');
        $this->load->helper('text');
        if($this->auth_dao->get_user_role() == 'admin') $this->is_login = 1;
        if(!$this->is_login)
        {
            header('Location: /admin/');
            die();
        }

        $this->menu = $this->menu_dao->get_menu();
        //$this->output->enable_profiler(TRUE);
        $this->rules['text'] = "required|min_length[25]|max_length[5000]";

    }

    function index()
    {
        $list = $this->common_dao->get_objects_list();
        $data = array(
            'container' => 'objects/news',
            'menu' => $this->menu,
            'list' => $list,
            'act_ok'=>  $this->uri->segment(4),
        );
        $this->load->view('admin/other', $data);
    }

    function edit($id)
    {
        $item = $this->common_dao->get_one_objects($id);
        $data = array(
            'container' => 'objects/edit',
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
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']	= '2048';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload())
            {
                $fname = '';
                $real_fname = '';
            }
            else
            {
                $thumb = $this->config->item('obj_foto');
                $data = $this->upload->data();
                $pinfo = pathinfo($data['file_name']);
                $this->load->library('ac_image_class', array('file'=>$_SERVER['DOCUMENT_ROOT'].'/uploads/'.$data['file_name']));
                unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$data['file_name']);
                $this->ac_image_class->resize($thumb['foto']['width'], $thumb['foto']['height']); //масштабировали изображение, вписав его в рамки
                $this->ac_image_class->save($_SERVER['DOCUMENT_ROOT'].'/uploads/', $pinfo['filename'], 'jpg', True, 100); //сохранили
                $this->ac_image_class->resize($thumb['thumb']['width'], $thumb['thumb']['height']); //масштабировали изображение, вписав его в рамки
                $this->ac_image_class->save($_SERVER['DOCUMENT_ROOT'].'/uploads/', $this->config->item('obj_foto_thumb').$pinfo['filename'], 'jpg', True, 100); //сохранили

                $fname = $pinfo['filename'].'.jpg ';
                $real_fname = $data['orig_name'];
            }


            $this->common_dao->objects_edit($id, array(
                'fname'=> $fname,
                'real_fname'=> $real_fname,
                'text'=>$this->input->post('text'))
            );
            $data = array(
                'container' => 'objects/edit',
                'menu' => $this->menu,
                'item' => $item[0],
            );
            $this->load->view('admin/other', $data);
        }
    }

    function add()
    {
        $data = array(
            'container' => 'objects/add',
            'menu' => $this->menu,
        );
        $this->load->helper(array('form', 'url'));
        $this->load->library('validation');
        $this->validation->set_rules($this->rules);
        if ($this->validation->run() == FALSE)
        {
            $data['container'] = 'objects/add';
        }
        else
        {
            # add objects
            $this->common_dao->objects_add(array(
                    'text'=>$this->input->post('text'))
            );
            redirect('/admin/objects/index/add_ok');
        }

        $this->load->view('admin/other', $data);
    }

    function del($id)
    {
        $foto = $this->common_dao->get_one_objects($id);
        unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$foto[0]->fname);
        unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$this->config->item('foto_thumb').$foto[0]->fname);
        $this->common_dao->objects_del($id);
        redirect('/admin/objects/index/del_ok');
    }


}



?>