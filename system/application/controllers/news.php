<?php

class News extends Controller {
    static $onpage = 3;

    function News()
    {
        parent::Controller();
        $this->load->model('admin/common_model', 'common_dao');
    }

    function index($page=0)
    {
        $breadcrumbs = array(
            array('path'=>'/',
                'name'=>'Главная'),
            array('path'=>'/',
                'name'=>'О нас'),
            array('path'=>'/news/',
                'name'=>'Новости'),
        );

        if($page)
        {
            $offset = $page * self::$onpage;
        }else
        {
            $offset=0;
        }
        $list = $this->common_dao->get_news_list(self::$onpage, $offset);

        $page_count = ceil($this->common_dao->news_count()/self::$onpage);
        $data = array(
            'container' => 'news_list',
            'breadcrumbs'=>$breadcrumbs,
            'list'=>$list,
            'pc'=>$page_count
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