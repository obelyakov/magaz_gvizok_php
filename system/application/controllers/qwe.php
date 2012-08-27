<?php

class qwe extends Controller {

	function qwe()
	{
		parent::Controller();	
	}
	
	function index()
	{
            echo "weqw";
            $this->load->model('qwemodel');
            echo $this->qwemodel->asd();
            $this->load->view('welcome_message');
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */