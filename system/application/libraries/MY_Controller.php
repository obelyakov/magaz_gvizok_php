<?
if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends Controller {

    public function __construct()
    {
        parent::Controller();
    }

    final public function _view_nocache($view = 'content', $data = array())
    {
        // посылаем заголовки чтобы не кешировал
        // Date in the past
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

        // always modified
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

        // HTTP/1.1
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);

        // HTTP/1.0
        header("Pragma: no-cache");
        $this->load->view($view, $data);
    }


}

?>