<?php
/**
 */
class Good extends Controller {

    public $is_login;
    public $menu;
    public $seria = array();
    public $shtml = '';
    public $slev = 0;
    public $add_but;
    public $del_but;

    function Good()
    {
        parent::Controller();
        $this->load->helper(array('form', 'url'));
        $this->load->model('admin/common_model', 'common_dao');
        $this->load->model('admin/menu', 'menu_dao');
        $this->load->model('admin/auth', 'auth_dao');
        $this->load->model('admin/goods_model', 'goods_dao');
        $this->load->model('admin/seria_model', 'seria_dao');
        $this->load->model('admin/tovcat_model', 'tovcat_dao');
        $this->load->library('session');
        cGood::set_db_class($this->tovcat_dao);
    }

    function index()
    {
        $form_act = $this->input->post('form_act');
        if($form_act)
        {# проверка формы
            $this->load->library('email');
            $config['protocol'] = 'sendmail';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;

            $this->email->initialize($config);

            $this->email->from('b.oleg@mail.ru', 'site');
            $this->email->to('b.oleg@mail.ru');
            #$this->email->cc('another@another-example.com');
            #$this->email->bcc('them@their-example.com');

            $this->email->subject('Письмо с сайты');
            $this->email->message($this->input->post('text'));

            $this->email->send();
        }

        $item = $this->common_dao->get_one_text(6);
        $html_form = $this->load->view('contact_form', array(), TRUE);
        $data = array(
            'text' => $item[0],
            'container' => 'text',
            'text2' => $html_form
        );

        $this->load->view('other', $data);
    }

    function lift($id)
    {
        $item = $this->common_dao->get_one_text(6);
        $html_form = $this->load->view('contact_form', array(), TRUE);

        $good = cGoodsFabric::get_good(38);

        $data = array(
            'text' => $item[0],
            'container' => 'good_lift',
            'text2' => $html_form
        );

        $this->load->view('other', $data);

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