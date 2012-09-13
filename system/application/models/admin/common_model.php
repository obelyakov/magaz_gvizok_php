<?
/** МОДЕЛЬ работы с товарами
 * 
 */

class common_model extends Model {

    function common_model()
    {
        parent::Model();
    }
    
    /** возвращает запись товара из БД (получаем seria_id)
     *
     * @param int id товара
     * @return object 
     */
    function get_news_list()
    {
        $this->db->select('*')
                ->from('news_tb')
                ->order_by('date', 'desc');
        $query = $this->db->get();
        if($query->num_rows > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }
    
    function get_one_news($id)
    {
        $this->db->select('*')
                ->from('news_tb')
                ->where('id', $id)
                ->order_by('date', 'desc');
        $query = $this->db->get();
        if($query->num_rows > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }
    
    function news_add($data)
    {
        return $this->db->insert('news_tb', $data);
    }

    function news_edit($id, $data)
    {
        return $this->db->update('news_tb', $data, array('id'=>$id));
    }
    
    function news_del($id)
    {
        return $this->db->delete('news_tb', array('id'=>$id));
    }




    function get_objects_list()
    {
        $this->db->select('*')
            ->from('objects_tb')
            ->order_by('id', 'desc');
        $query = $this->db->get();
        if($query->num_rows > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }

    function get_one_objects($id)
    {
        $this->db->select('*')
            ->from('objects_tb')
            ->where('id', $id)
            ->order_by('id', 'desc');
        $query = $this->db->get();
        if($query->num_rows > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }

    function objects_add($data)
    {
        return $this->db->insert('objects_tb', $data);
    }

    function objects_edit($id, $data)
    {
        return $this->db->update('objects_tb', $data, array('id'=>$id));
    }

    function objects_del($id)
    {
        return $this->db->delete('objects_tb', array('id'=>$id));
    }



    function get_text_list()
    {
        $this->db->select('*')
            ->from('text_tb')
            ->order_by('date', 'desc');
        $query = $this->db->get();
        if($query->num_rows > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }

    function get_one_text($id)
    {
        $this->db->select('*')
            ->from('text_tb')
            ->where('id', $id)
            ->order_by('date', 'desc');
        $query = $this->db->get();
        if($query->num_rows > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }

    function text_add($data)
    {
        return $this->db->insert('text_tb', $data);
    }

    function text_edit($id, $data)
    {
        return $this->db->update('text_tb', $data, array('id'=>$id));
    }

    function text_del($id)
    {
        return $this->db->delete('text_tb', array('id'=>$id));
    }

}
?>