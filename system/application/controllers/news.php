<?php

class News extends Controller {

    function News()
    {
        parent::Controller();
        $this->load->model('admin/common_model', 'common_dao');
    }

    function index()
    {
        $breadcrumbs = array(
            array('path'=>'/',
                'name'=>'Главная'),
            array('path'=>'/',
                'name'=>'О нас'),
            array('path'=>'/news/',
                'name'=>'Новости'),
        );

        $list = $this->common_dao->get_news_list();

        $data = array(
            'container' => 'news_list',
            'breadcrumbs'=>$breadcrumbs,
            'list'=>$list,
        );
        $this->load->view('other', $data);
    }

    function item($id)
    {
        $breadcrumbs = array(
            array('path'=>'/',
                'name'=>'Главная'),
            array('path'=>'/',
                'name'=>'О нас'),
            array('path'=>'/news/',
                'name'=>'Новости'),
        );

        $item = $this->common_dao->get_one_news($id);

        $data = array(
            'container' => 'news_item',
            'breadcrumbs'=>$breadcrumbs,
            'item'=>$item[0],
        );
        $this->load->view('other', $data);
    }
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */