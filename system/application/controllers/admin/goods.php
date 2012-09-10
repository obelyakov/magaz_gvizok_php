<?php

/**
 *  КОНТРОЛЛЕР Работа с ТОВАРАМИ Админский класс
 *  @property goods_model $goods_dao
 */
class Goods extends Controller {

    public $is_login;
    public $menu;
    public $seria = array();
    public $shtml = '';
    public $slev = 0;
    public $add_but;
    public $del_but;

    function Goods()
    {
        parent::Controller();
        //$this->output->enable_profiler(TRUE);
        $this->load->model('admin/menu', 'menu_dao');
        $this->load->model('admin/auth', 'auth_dao');
        $this->load->model('admin/tovcat_model', 'tovcat_dao');
        $this->load->model('admin/goods_model', 'goods_dao');
        $this->load->model('admin/seria_model', 'seria_dao');

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
        cGood::set_db_class($this->tovcat_dao);
        
        //var_dump(cGoodsFabric::get_good(3)->get_value());
        
        
        
    }

    function index()
    {
        #$items = $this->tovcat_dao->get_tovcat();
        #var_dump($items );
        

        $data = array(
            'container' => 'goods',
            'menu' => $this->menu,
            'goods' => 'nogood',
            'shtml' => $this->seria_dao->get_tree_value(0),
            'level0_addbut' => $this->seria_dao->_add_but(0),
            'seria_id' => 0
            );
        //var_dump($data);
        $this->load->view('admin/other', $data);
        
    }
    
    # страница товаров серии
    function edit()
    {
        //получаем id серии для которой нужно выводить товары
        $seria_id = $this->uri->segment(4);
        $goods = $this->goods_dao->get_goods_by_seria($seria_id);
        if($goods)
        {
            $goods_obj = array();
            $good_attr = array();
            $good_shap = array();
            foreach($goods as $k => $v)
            {
                $goods_obj[$v->id_good] = cGoodsFabric::get_good($v->id_good);
                $good_attr[$v->id_good] = $goods_obj[$v->id_good]->get_value()->get_value();
            }

            // получаем шапку в удобном виде
            // массив объектов из последнего
            $arr1 = $goods_obj[$v->id_good]->get_value()->get_key();
            $onmain_arr = array();
            foreach($arr1 as $v)
            {
                $good_shap[$v->id_filedtc] = $v;
                if($v->onmain=='Y')
                    $onmain_arr[] = $v->id_filedtc;
            }
            $good_exist = 1;
        }else{
            $good_exist = 0;
        }

        $data = array(
            'container' => 'goods',
            'menu' => $this->menu,
            'shtml' => $this->seria_dao->get_tree_value(0, array()),
            'level0_addbut' => $this->seria_dao->_add_but(0)
            );
        
        if($good_exist){
            $data['goods'] = $goods_obj;
            $data['shap'] = $good_shap;
            $data['onmain'] = $onmain_arr;
            $data['good_exist'] = 1;
        }else{
            $data['goods'] = 'nogood';
            $data['nogood'] = 1;
        }
        if($this->uri->segment(5)=='foto1')
            $data['mess'] = 'Фотографию не удалось загрузить';
        
        $data['seria_id'] = $seria_id;

        $this->load->view('admin/other', $data);
    }
    
    /**
     * Окно-Форма добавления товара
     * @param type $id_seria
     * @return type 
     */
    function add($id_seria)
    {
        if(!$id_seria){echo "Внутренняя ошибка  - не задан номер серии";return;}

        # получение серии
        $seria = $this->seria_dao->get_item($id_seria);
        #var_dump($seria->id_seria );
        # получение полей товарной категории
        $tcf = $this->tovcat_dao->get_tc_fields($seria->id_tovcat);
        
        $data = array(
            'container' => 'goods/good_add',
            );
        $data['tcf'] = $tcf;
        $data['seria_id'] = $id_seria;

        $this->load->view('admin/layout_ajax_empty', $data);
    }
    
    /**  AJAX обработка POST формы добавления товара
     * 
     */
    function ajax_add_post()
    {
        //var_dump($_POST);
        $this->goods_dao->add_good($this->input->post('seria_id'), $_POST['id_filedtc']);
        //print (" <script>alert('zapp') </script>");
        
    }
    
    /**  AJAX обработка POST формы редактирования товара
     * 
     */
    function ajax_edit_post()
    {
        print "dqweqw";
        var_dump($_POST);
        $this->goods_dao->edit_good($this->input->post('good_id'), $this->input->post('seria_id'), $_POST['id_filedtc']);


    }
    
    /**  Окно-форма редактирования товара
     * @param type $id_good 
     */
    function editone($id_good)
    {
        $good = $this->goods_dao->get_good($id_good);
        $id_seria = $good[0]->id_seria;
        $good = cGoodsFabric::get_good($id_good);        
        $val = array();
        foreach($good->get_value()->get_value() as $v)
        {
            $val[$v->id_fieldtc] = $v->value;
        }
            

        # получение серии
        $seria = $this->seria_dao->get_item($id_seria);
        #var_dump($seria->id_seria );
        # получение полей товарной категории
        $tcf = $this->tovcat_dao->get_tc_fields($seria->id_tovcat);
        
        $data = array(
            'container' => 'goods/good_edit',
            );

        $data['foto'] = $this->goods_dao->get_foto($id_good);
        $data['file'] = $this->goods_dao->get_file($id_good);
        $data['good_id'] = $id_good;
        $data['tcf'] = $tcf;
        $data['seria_id'] = $id_seria;
        $data['val'] = $val;

        $this->load->view('admin/layout_ajax_empty', $data);
    }

    
    /**  фук-ция удаления товара
     * @param type $id_good 
     */
    function delone($id_good)
    { #TODO при удалении товара удалить все его файлы и фото (база и файлы)
        $this->load->model('admin/goods_model', 'goods_dao');
        $good = $this->goods_dao->get_good($id_good);
        $this->goods_dao->del_good($id_good);
        redirect('/admin/goods/edit/'.(string) $good[0]->id_seria);
        die();
    }


    function upload_foto()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '2048';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
            redirect('/admin/goods/edit/'.(string) $this->input->post('seria_id').'/foto1');
        }
        else
        {
            $thumb = $this->config->item('good_foto');
            $data = $this->upload->data();
            $pinfo = pathinfo($data['file_name']);
            $this->load->library('ac_image_class', array('file'=>$_SERVER['DOCUMENT_ROOT'].'/uploads/'.$data['file_name']));
            unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$data['file_name']);
            $this->ac_image_class->resize($thumb['foto']['width'], $thumb['foto']['height']); //масштабировали изображение, вписав его в рамки
            $this->ac_image_class->save($_SERVER['DOCUMENT_ROOT'].'/uploads/', $pinfo['filename'], 'jpg', True, 100); //сохранили
            $this->ac_image_class->resize($thumb['thumb']['width'], $thumb['thumb']['height']); //масштабировали изображение, вписав его в рамки
            $this->ac_image_class->save($_SERVER['DOCUMENT_ROOT'].'/uploads/', $this->config->item('foto_thumb').$pinfo['filename'], 'jpg', True, 100); //сохранили

            $this->goods_dao->add_foto($this->input->post('good_id'), $pinfo['filename'].'.jpg ', $data['orig_name']);
            redirect('/admin/goods/edit/'.(string) $this->input->post('seria_id'));
        }
    }

    function upload_file()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'pdf|zip|rar|xls|doc';
        $config['max_size']	= '2048';
        #$config['max_width']  = '1024';
        #$config['max_height']  = '768';
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
            redirect('/admin/goods/edit/'.(string) $this->input->post('seria_id').'/foto1');
        }
        else
        {
            $data = $this->upload->data();
            $pinfo = pathinfo($data['file_name']);
            $this->goods_dao->add_file($this->input->post('good_id'), $pinfo['filename'].".".$pinfo['extension'], $data['orig_name']);
            redirect('/admin/goods/edit/'.(string) $this->input->post('seria_id'));
        }
    }
    /**  фук-ция удаления фото
     * @param type $id_good
     */
    function delfoto($id_foto)
    {
        $foto = $this->goods_dao->get_foto_byid($id_foto);
        unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$foto[0]->fname);
        unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$this->config->item('foto_thumb').$foto[0]->fname);
        $this ->goods_dao->del_foto($id_foto);
        redirect('/admin/goods/edit/'.(string) $this->uri->segment(5));
        die();
    }

    /**  фук-ция удаления Файла
     * @param type $id_good
     */
    function delfile($id_foto)
    {
        $foto = $this->goods_dao->get_file_byid($id_foto);
        unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$foto[0]->fname);
        $this ->goods_dao->del_file($id_foto);
        redirect('/admin/goods/edit/'.(string) $this->uri->segment(5));
        die();
    }

}




#####################################################################################
#####################################################################################
#####################################################################################

# класс данных
class gvalue
{
    private $key = array();
    private $value = array();
    
    /** установка массива объектов ключей (табла  tovcat_fields_tb)*/
    function set_key($key){
        $this->key = $key;
    }
    
    /** установка массива объектов значений */
    function set_value($value){
        $this->value = $value;
    }

    function get_key(){
        return $this->key;
    }
    
    function get_value(){
        return $this->value;
    }

}


interface iGood
{
    public function get_id();
    public function get_seria_id();
    public function get_value();

    public function set_id($id);
    public function set_seria_id($id);
    public function set_value($value);
}


class cGood implements iGood
{
    private $id;
    private $seria_id;
    // переменная модержащая класс данных
    private $value;
    /** ссылка на класс модели работы с БД CI
     * @CI_model link
     */
    private static $CI_model;
    
    public function __construct() {
        //$this->CI_model = $l;
    }
    
    public static function set_db_class($db)
    {
        self::$CI_model = $db;
    }

    public static function get_db_class()
    {
        return self::$CI_model;
    }
    
    public function get_id(){
        return $this->id;
    }

    public function get_test($id){
        $a = self::$CI_model->get_tc_fields($id);
        return $a;
    }
    
    public function get_seria_id(){
        return $this->seria_id;
    }
    
    public function get_value(){
        return $this->value;
    }

    public function set_id($id){
        $this->id = $id;
    }
    
    public function set_seria_id($id){
        $this->seria_id = $id;
    }
    
    public function set_value($value){
        $this->value = $value;
    }
    
}

/** фаблика объектов товаров
 *  
 */
class cGoodsFabric
{
    private static $goods = array();
    private static $CI_model;
    
    /** возвращает объект товара по заданному ID
     *
     * @param int $id ИД
     * @return object 
     */
    public static function get_good($id)
    {
        self::$CI_model = cGood::get_db_class();
        if(!isset(self::$goods[$id])){
            self::$goods[$id] = New cGood();
            /* получение данных о продукте по id. Заполнение объекта*/
            //установили ID продукта
            self::$goods[$id]->set_id($id);
            //****получаем и устанавливаем серию
            $good = self::$CI_model->goods_dao->get_good($id);
            self::$goods[$id]->set_seria_id($good[0]->id_seria);
            //****получение и установка значение продукта
            //получение серии
            $seria = self::$CI_model->seria_dao->get_item($good[0]->id_seria);
            // получаем поля товарной категории
            $tc_f = self::$CI_model->tovcat_dao->get_tc_fields($seria->id_tovcat);
            
            // создания объекта "данных"
            $gv = New gvalue();
            // заполнения свойства ключей в объекте данных
            $gv->set_key($tc_f);
            // получение данных для каждого из ключений (поля товарной категории для данного товара)
            $gsd = array();
            foreach($tc_f as $v)
            {
                // получение таблицы хранения "данных" этого поля
                $mysql_table = self::$CI_model->tovcat_dao->get_tc_type($v->ftype);
                // получение данных по определенному полю
                $gd = self::$CI_model->goods_dao->get_goods_data($mysql_table[0]->mysql_table, $id, $v->id_filedtc);
                $gsd[] = $gd;
            }
            
            // заполнения свойства данных в объекте данных
            $gv->set_value($gsd);
            
            // установка объекта данных в объект товара
            self::$goods[$id]->set_value($gv);
        }
        
        return self::$goods[$id];
    }
    
    
}


?>