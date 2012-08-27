<?php


/** МОДЕЛЬ работа с сериями
 * 
 */
class seria_model extends Model {
    
    public $shtml = '';
    public $slev = 0;
    

    function seria_model()
    {
        $this->add_but = '<img src="/adminnn/images/ico/add16.png">';
        $this->del_but = '<img src="/adminnn/images/ico/remove16.png">';
        parent::Model();
    }

    function get_item($id)
    {
        $this->db->where('id_seria', $id);
        $query = $this->db->get('seria_tb');
        if($query->num_rows()>0){
            $all = $query->result();
            return $all[0];
        }else{
            return FALSE;
        }
        
    }

    function get_items($param = array())
    {
        $this->db->where($param);
        $query = $this->db->get('seria_tb');
        if($query->num_rows > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }
    
    function set_item($id, $param)
    {
        if(!$id) return;
        $this->db->where(array('id_seria'=>$id));
        return $this->db->update('seria_tb', $param);
    }

    function add_item($param)
    {
        return $this->db->insert('seria_tb', $param);
    }
    

    function del_item($id)
    {
        return $this->db->delete('seria_tb', array('id_seria'=>$id));
    }
    
    
    function _get_tree($id, $param )
    {
        $this->slev++;
        $ret = array();
        $arr = $this->get_items(array('parent_id' => $id));
        if(is_array($arr)){
            foreach($arr as $v){
                if(in_array('add', $param)) $abut = $this->_add_but($v->id_seria); else $abut = '';
                if(in_array('del', $param)) $dbut = $this->_del_but($v->id_seria); else $dbut = '';
                $t = $this->get_items(array('parent_id' => $v->id_seria));
                if(is_array($t)){//если есть дети
                        if($this->slev>1) $s = 'style="display:none;"'; else $s = '';
                        $this->shtml.= '<li '.$s.'>'.anchor($this->_edit_but($v->id_seria), $v->sname).$abut.' '.$dbut.'<ul>';
                        $this->shtml.= '<a href="#" class="demo6"></a>';
                        $ret[$v->id_seria] = $this->_get_tree($v->id_seria, $param);
                        $this->shtml.= '</ul></li>';
                }else{
                    $ret[$v->id_seria] = $v->id_seria;
                    if($this->slev>1) $s = 'style="display:none;"'; else $s = '';
                    $this->shtml.= '<li '.$s.'>'.anchor($this->_edit_but($v->id_seria), $v->sname).$abut.' '.$dbut.'</li>';
                }

            }
        }else{
        }
        $this->slev--;
        return $ret;
    }
    
    function _add_but($parent_id)
    {//формирование кнопки для дерева
        return anchor('/admin/'.$this->uri->segment(2).'/add/'.$parent_id.'/', $this->add_but, array('style'=>'padding: 0 0 0 0'));
    }

    function _edit_but($id)
    {//формирование кнопки для дерева
        return '/admin/'.$this->uri->segment(2).'/edit/'.$id.'/';
    }

    function _del_but($id)
    {//формирование кнопки для дерева
        return anchor('/admin/'.$this->uri->segment(2).'/del/'.$id.'/', $this->del_but, array('style'=>'padding: 0 0 0 0'));
    }
    
    /** 
     * возвращает сформированную переменную дерева серии
     * процедурой _get_tree
     */
    function get_tree_value($level, $param = array('button'=> array('add', 'del')))
    {
        if(isset($this->shtml) && $this->shtml){
            return $this->shtml;
        }
        else{
            $this->_get_tree($id = 0, $param);
            return $this->shtml;
        }
    }

    
}

?>
