<?php

class auth extends Model {

    function auth()
    {
        parent::Model();
    }


    function get_user_role()
    {
        if($this->session->userdata('userlogin')==1)
        {
            return 'admin';
        }
        else
        {
            return 'anonim';
        }

    }

    
}

?>
