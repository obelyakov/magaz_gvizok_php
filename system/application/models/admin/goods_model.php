<?php
/** МОДЕЛЬ работы с товарами
 * 
 */


class goods_model extends Model {

    function goods_model()
    {
        parent::Model();
    }
    
    /** возвращает запись товара из БД (получаем seria_id)
     *
     * @param int id товара
     * @return object 
     */
    function get_good($id)
    {
        $this->db->select('*')
                ->from('goods_tb')
                ->where('id_good', $id);
        $query = $this->db->get();
        if($query->num_rows > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }
    
    /** 
     * Получение определенного поля по 3м данным
     * @param $mysql_table string таблица данных 
     * @param $id_good int ID товара
     * @param $id_filed int ID поля
     */
    function get_goods_data($mysql_table, $id_good, $id_field)
    {
        //echo $mysql_table,' ', $id_good,' ', $id_field,'<br>';
        $this->db->select('*')
                ->from($mysql_table)
                ->where(array('id_good' => $id_good, 
                              'id_fieldtc' => $id_field));
        $query = $this->db->get();
        if($query->num_rows > 0){
            $r = $query->result();
            return $r[0];
        }else{
            return FALSE;
        }
    }
    
    /** 
     * возвращает список товаров в серии
     * @param type $is_seria 
     */
    function get_goods_by_seria($id_seria)
    {
        $this->db->select('*')
                ->from('goods_tb')
                ->where(array('id_seria' => $id_seria));
        $query = $this->db->get();
        if($query->num_rows > 0){
            $r = $query->result();
            return $r;
        }else{
            return FALSE;
        }
    }
    
    /** 
     * Добавляет новый товар в базу.
     * @param int $seria_id  id серии
     * @param array $good_param массив параметров товара
     */
    function add_good($seria_id, $good_param)
    {
        # получаем id товарной категории
        $this->db->select('*')
                ->from('seria_tb')
                ->where('id_seria', $seria_id);
        $query = $this->db->get();
        if($query->num_rows == 0)
            return false;
        $seria = $query->result();
        $tovcat_id = $seria[0]->id_tovcat;
        
        #вставляет запись в таблицу товаров (новый товар)
        $good = array(
            'id_seria' => $seria_id
        );
        $this->db->insert('goods_tb', $good);
        $good_id = $this->db->insert_id();
        
        foreach($good_param as $id_filedtc => $value)
        {
            $this->db->select('*')
                    ->from('tovcat_fields_tb')
                    ->join('ftypes_tb', 'tovcat_fields_tb.ftype=ftypes_tb.ftype', 'left')
                    ->where('id_filedtc', $id_filedtc);
            $query = $this->db->get();
            $res = $query->result();
            $mysql_table = $res[0]->mysql_table;
            
            #формирование массива для вставки очередного знаничения товара
            $vval = array(
                'id_good' => $good_id,
                'id_fieldtc' => $id_filedtc,
                'value' => $value
            );
            $this->db->insert($mysql_table, $vval);
        }
    }
           
        
    /** 
     * Редактирует товар в базе.
     * @param int $good_id  id редактируемого товара
     * @param int $seria_id  id серии
     * @param array $good_param массив параметров товара
     */
    function edit_good($good_id, $seria_id, $good_param)
    {
        # получаем id товарной категории
        $this->db->select('*')
                ->from('seria_tb')
                ->where('id_seria', $seria_id);
        $query = $this->db->get();
        if($query->num_rows == 0)
            return false;
        $seria = $query->result();
        $tovcat_id = $seria[0]->id_tovcat;
        
        foreach($good_param as $id_filedtc => $value)
        {
            $this->db->select('*')
                    ->from('tovcat_fields_tb')
                    ->join('ftypes_tb', 'tovcat_fields_tb.ftype=ftypes_tb.ftype', 'left')
                    ->where('id_filedtc', $id_filedtc);
            $query = $this->db->get();
            $res = $query->result();
            $mysql_table = $res[0]->mysql_table;
            
            #формирование массива для редактирования очередного знаничения товара
            $where = array(
                'id_good' => $good_id,
                'id_fieldtc' => $id_filedtc
            ); 
            $data = array(
                'value' => $value
            );
            $this->db->where($where);
            $this->db->update($mysql_table, $data);
        }
    }
    
    /** 
     * Удаляет товар из базы, со всеми связанными данными, ценами.
     * @param int $id_good  id удаляемого товара
     */    
    function del_good($id_good)
    {
        //удаляем сам товар
        $this->db->delete('goods_tb', array('id_good'=>$id_good));
        //удаляем данные (текст, числа, строки)
        $this->db->delete('data_string', array('id_good'=>$id_good));
        $this->db->delete('data_int', array('id_good'=>$id_good));
        $this->db->delete('data_text', array('id_good'=>$id_good));
        //удаляем цены
        $this->db->delete('price_tb', array('good_id'=>$id_good));
        return True;
    }

    function add_foto($good_id, $name, $real_name)
    {
        $this->db->insert('photo_good_tb', array('good_id'=>$good_id,
                'fname'=>$name,
                'real_fname'=>$real_name)
        );
    }

    function add_file($good_id, $name, $real_name)
    {
        $this->db->insert('file_good_tb', array('good_id'=>$good_id,
                'fname'=>$name,
                'real_fname'=>$real_name)
        );
    }

    function del_foto($id)
    {
        $this->db->delete('photo_good_tb', array('id'=>$id));
    }

    function del_file($id)
    {
        $this->db->delete('file_good_tb', array('id'=>$id));
    }

    function get_foto($good_id)
    {
        $this->db->select()->from('photo_good_tb')->where(array('good_id'=>$good_id));
        $query = $this->db->get();
        return $query->result();
    }

    function get_file($good_id)
    {
        $this->db->select()->from('file_good_tb')->where(array('good_id'=>$good_id));
        $query = $this->db->get();
        return $query->result();
    }

    function get_foto_byid($id)
    {
        $this->db->select()->from('photo_good_tb')->where(array('id'=>$id));
        $query = $this->db->get();
        return $query->result_object();
    }

    function get_file_byid($id)
    {
        $this->db->select()->from('file_good_tb')->where(array('id'=>$id));
        $query = $this->db->get();
        return $query->result_object();
    }
}



?>