<?php

/**
 * @property grocery_crud grocery_crud
 */
class main extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->helper('url');

        $this->load->library('grocery_CRUD');
        $this->auth = new stdClass;
        $this->load->library('flexi_auth');
        if (!$this->flexi_auth->is_logged_in()) {
            redirect('user/login');
        }
    }

    function index() {
        $this->voters();
//        $this->load->view('main_view');
    }

    function voters() {
        $crud = new grocery_CRUD();
        $crud->set_theme('twitter-bootstrap');
        $crud->set_subject('Voter');
        $crud->set_table('voters');
        $crud->unique_fields('phone','national_id');
        $crud->unset_fields('confirmation_code');
        $crud->unset_columns('confirmation_code');

        $output = $crud->render();
        $this->load->view('main_view', $output);
    }

    function parties() {
        $crud = new grocery_CRUD();
        $crud->set_theme('twitter-bootstrap');
        $crud->set_subject('party');
        $crud->set_table('parties');
        $crud->set_primary_key('party_id');
        $crud->set_field_upload('party_symbol', 'uploads');
        $crud->unset_columns('party_id');
        $crud->unset_fields('party_id');
        $output = $crud->render();
        $this->load->view('main_view', $output);
    }

    function candidates() {
        $crud = new grocery_CRUD();
        $crud->set_theme('twitter-bootstrap');
        $crud->set_subject('Candidate');
        $crud->set_table('candidates');
        $crud->set_primary_key('candidate_id');
        $crud->set_relation('party_id', 'parties', 'party_initials');
        
        $crud->display_as('party_id','Party');
        $crud->set_field_upload('candidate_photo', 'uploads');
        $output = $crud->render();
        $this->load->view('main_view', $output);
    }
    

}

?>
