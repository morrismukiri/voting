<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property flexi_auth $flexi_auth
 */
class signup extends CI_Controller {

    function __construct() {
        parent::__construct();
          $this->auth = new stdClass;
        $this->load->library('flexi_auth');
    }

    public function index()
	{
        
           $this->load->view('login',$data);
        }
}
