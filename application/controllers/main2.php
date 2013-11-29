<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of main
 *
 * @author Morris
 * @property PHPExcel $excel Description
 * @property crud $crud crud model
 * @property  flexi_auth $flexi_auth Flexi auth Library
 * @property common_model $common_model common_model
 */
class main2 extends CI_Controller {

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

        $this->message();
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

    function contacts() {
//        try {
        $crud = new grocery_CRUD();
        $this->flexi_auth->set_status_message($this->session->flashdata('info'));
        $this->flexi_auth->set_error_message($this->session->flashdata('error'));
        $crud->set_theme('twitter-bootstrap');
        $crud->set_subject('Contact');
        $crud->set_table('contacts');
        $crud->unset_columns('status', 'groups');
        $crud->unset_fields('status', 'groups');
        $crud->required_fields('name', 'phone');
        $crud->display_as('name', 'Full Name');
        $crud->display_as('phone', 'Phone No');
        $output = $crud->render();
        $this->load->view('main_view', $output);
//        } catch (Exception $e) {
//            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
//        }
    }

    function groups() {
//        try {
        $crud = new grocery_CRUD();

        $crud->set_theme('twitter-bootstrap');
        $crud->set_subject('Group');
        $crud->set_table('group');
        $crud->unset_fields('status');
        $crud->unset_columns('status');
        $crud->required_fields('Name', 'Description');
        $crud->display_as('Name', 'Name of Group');
        $crud->display_as('Description', 'Group Description');
        $output = $crud->render();
        $this->load->view('main_view', $output);
//        } catch (Exception $e) {
//            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
//        }
    }

    function contact_grouping() {
//         try {
        $crud = new grocery_CRUD();

        $crud->set_theme('twitter-bootstrap');
        $crud->set_subject('Contact in Group');
        $crud->set_table('contact_groups');
        $crud->fields('contact_id', 'group_id');
        $crud->set_relation('contact_id', 'contacts', 'name');
        $crud->set_relation('group_id', 'group', 'name');
        $crud->unset_columns('status');
        $crud->unset_fields('status');
        $crud->required_fields('Name', 'Description');
        $crud->display_as('contact_id', 'Name of Contact');
        $crud->display_as('group_id', 'Group');
        $output = $crud->render();
        $this->load->view('main_view', $output);
//        } catch (Exception $e) {
//            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
//        }
    }

    function import_contacts() {
        //if ($this->input->post()) {
        $config['upload_path'] = './assets/uploads/files/';
        $config['allowed_types'] = 'xls|xlsx|csv';

        $this->load->library('upload', $config);
        if ($this->upload->do_upload()) {

            echo 'uploaded';
            $this->load->library('excel');

            $objPHPExcel = PHPExcel_IOFactory::load('./assets/uploads/files/' . $this->upload->file_name);

            $objPHPExcel->setActiveSheetIndex();
            $cursheet = $objPHPExcel->getActiveSheet();
            $highestRow = $cursheet->getHighestRow(); // e.g. 10
            $highestColumn = $cursheet->getHighestColumn(); // e.g 'F'
            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
//        $nrColumns = ord($highestColumn) - 64;

            for ($row = 2; $row <= $highestRow; $row++) {
                $name = $cursheet->getCellByColumnAndRow(0, $row);
                $phone = $cursheet->getCellByColumnAndRow(1, $row);
                $email = $cursheet->getCellByColumnAndRow(2, $row);
                $insdata = array(
                    'name' => "$name",
                    'phone' => "$phone",
                    'email' => "$email"
                );
                $this->crud->add('contacts', $insdata);
            }
            $this->session->set_flashdata("info", "Upload Completed. $highestRow contacts imported");
            redirect('main/contacts');
        } else {
            $this->session->set_flashdata('error', 'Upload error ' . $this->upload->display_errors());
            redirect('main/contacts');
            //$data['error'] = $this->upload->display_errors();
            //  echo $this->upload->data();
            //$this->load->view('upload');
            //print_r($this->upload->data());
        }
    }

    function message() {
        $data['groups'] = $this->common_model->get_groups();
        $data['contacts'] = $this->common_model->get_contacts();
        $this->load->view('message', $data);
//        $this->load->view('includes/topbar');
//        $this->load->view('main_view',$data);        
//        $this->load->view('includes/footer');
    }

    function send() {
        $contacts = implode(',', $this->input->post('contacts'));
        
        $message = $this->input->post('msg');
        $res=$this->common_model->send_message('modern', 'modernmarcel', $contacts, $message);
        print_r($res);
    }

    function get_contacts_in_group_ajax($group_id = -1) {
        $contacts = $group_id == -1 ? $this->common_model->get_contacts() : $this->common_model->get_contact_groups($group_id);
        if ($contacts <> NULL) {
            foreach ($contacts as $contact) {
                echo"<label for ='contact_$contact->id'  class=' label'><input type='checkbox' name='contacts[]' id='contact_$contact->id' value='$contact->phone'  class='contact'/> $contact->name</label> <br/>";
            }
        }
    }

}

?>
