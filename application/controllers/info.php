<?php

/**
 * Controller to Get information
 *
 * @author Morris
 */
class info extends CI_Controller{

    function index() {
$this->view();
       // $this->load->view('home');
    }
function view($page='home') {

        $this->load->view($page);
    }
}

?>
