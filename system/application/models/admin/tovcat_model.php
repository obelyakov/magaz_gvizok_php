<?php
/** МОДЕЛЬ работы с товарными категориями
 * 
 */


class tovcat_model extends Model {

    function tovcat_model()
    {
        parent::Model();
    }
    
    /** возвращает товарную категорию
     *
     * @param array массив для выборки из БД
     * @return object 
     */
    function get_tovcat($param = array())
    {
        $this->db->where($param);
        $query = $this->db->get('tovcat_tb');
        if($query->num_rows > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }
    
    /** возвращает поля товарной категории 
     * @param int $id ID товарной категории
     * @return array 
     */
    function get_tc_fields($id)
    {
        $this->db->where(array('id_tovcat' => $id));
        $this->db->order_by('order', 'ASC');
        $this->db->order_by('onmain', 'ASC');
        $query = $this->db->get('tovcat_fields_tb');
        if($query->num_rows > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }
    
    function addedit_tovcat($param)
    {
        $data = array('name' => $param['tc_name'], 'descr' => $param['tc_descr'], 
                    'id_tovcat' => isset($param['id_tovcat']) ? $param['id_tovcat'] : 0);
        // если редактирование
        if(isset($param['id_tovcat']))
        {
            $data = array();
            foreach($param['name'] as $k => $v){
                $data = array('id_tovcat' => $param['id_tovcat'],
                              'name' => $param['name'][$k],
                              'ftype' => $param['ftype'][$k],
                              'size' => $param['size'][$k],
                              'order' => $param['order'][$k],
                              'onmain' => $param['onmain'][$k],
                              'descr' => $param['descr'][$k],
                    );
                // если отредактировали и добавили
                if(!$param['id_filedtc'][$k])
                {
                    $this->db->insert('tovcat_fields_tb', $data);
                }
                else
                {
                    $this->db->where('id_filedtc', $param['id_filedtc'][$k]);
                    $this->db->update('tovcat_fields_tb', $data);
                }
            }
            //сделать чтобы при клонировании в товарных категориях не клонировался id поля тк
            return $param['id_tovcat'];
            //$this->del_tovcat($param['id_tovcat']);
        }
        
        $this->db->insert('tovcat_tb', $data);
        $id_tovcat = $this->db->insert_id();
        
        $data = array();
        foreach($param['name'] as $k => $v){
            $data = array('id_tovcat' => $id_tovcat,
                          'name' => $param['name'][$k],
                          'ftype' => $param['ftype'][$k],
                          'size' => $param['size'][$k],
                          'order' => $param['order'][$k],
                          'onmain' => $param['onmain'][$k],
                          'descr' => $param['descr'][$k],
                );
            $this->db->insert('tovcat_fields_tb', $data);
        }
        return $id_tovcat;
    }

    /* удаление товарной категории (+ Триггер удаляются все поля)*/
    function del_tovcat($id)
    {
        $this->db->delete('tovcat_tb', array('id_tovcat' => $id));
        $this->db->delete('tovcat_fields_tb', array('id_tovcat' => $id));
    }
    
    /** 
     * Возвращает по типу полу информаци из справочника типов полей (тип + имя таблицы хранения эти данных) 
     * @param string $id
     * @return array object 
     */
    function get_tc_type($id)
    {
        $this->db->where(array('ftype' => $id));
        $query = $this->db->get('ftypes_tb');
        if($query->num_rows > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }
    
    
    
}
?>
