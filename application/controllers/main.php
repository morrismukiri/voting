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
      function positions() {
        $crud = new grocery_CRUD();
        $crud->set_theme('twitter-bootstrap');
        $crud->set_subject('position');
        $crud->set_table('electoral_positions');
        $crud->set_primary_key('position_id');
        
        $crud->unset_columns('position_id');
        $crud->unset_fields('position_id');
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
        $crud->set_relation('electoral_position_id', 'electoral_positions', 'position_name');
        
        $crud->display_as('party_id','Party');
        $crud->display_as('electoral_position_id','Position');
        $crud->set_field_upload('candidate_photo', 'uploads');
        $output = $crud->render();
        $this->load->view('main_view', $output);
    }
    function students(){
         $crud = new grocery_CRUD();
           $crud->set_theme('twitter-bootstrap');
//        $crud->set_subject('Student');
//        $crud->set_table('students');
         $output = $crud->render();
        $this->load->view('main_view', $output);    
    }
    

}

?>
