<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @property flexi_auth $flexi_auth
 * @property common_model $common_model Common Model
 */
class home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->auth = new stdClass;
        $this->load->library('flexi_auth');
    }

    public function index() {
        //if($this->flexi_auth->is_logged_in()){
       $data['votes'] =$this->common_model->get_votes();
       //   header('Content-Type: application/json');
       // echo json_encode($data['votes']);
       // die();
       $data['positions']=$this->common_model->get_all_records('electoral_positions');
        $this->load->view('home_view',$data);
//        }  else {
//            redirect('user/login','refresh');
//           //$this->load->view('login');
//        }
    }
    function cast($candidate_id,$voter_id) {
        $data=array(
            'voter_id'=>$voter_id,
            'candidate_id'=>$candidate_id
        );
        $this->common_model->insert_data('votes', $data);
        $in['hasvoted']=$this->common_model->hasVotedForAll($voter->voter_id);
        $this->load->view('vote_view',$in);
    }

    function vote($confirm = '') {
        $this->form_validation->set_rules('phone', 'Phone No.', 'required|trim|callback_number_check');//phone number validation rules

        if ($this->input->post('phone') && !$this->input->post('confirmationcode') && $confirm !== '') {//user just entered the phone number to receive confirmation code
            
            if ($this->form_validation->run()) {//check whether valid phone number
                $randomcode = $this->generateRandomString(5);//generete a random code
                $updata = array(
                    'confirmation_code' => $randomcode
                );
                $this->common_model->update_record('voters', $updata, 'phone', set_value('phone'));//save the code in the db
                $this->common_model->send_sms(set_value('phone'), 'your confirmation code to vote is: ' . $randomcode);// send the code to the user by sms
            }  
             $this->load->view('confirm_vote_view');    
            
        } elseif ($this->input->post('phone') && $this->input->post('confirmationcode')) {//user entered the validation code
            $this->form_validation->set_rules('confirmationcode', 'Confirmation Code', 'required|trim|callback_assert_confirmation');//add confirmation code validation rule
            if ($this->form_validation->run()) {//check whether valid confirmation code
                $num=$this->input->post('phone');//
                $voter = $this->common_model->find_in_db('voters', 'phone', $num);
                $data['voter']=$voter[0];
                $data['candidates']=  $this->common_model->getcandidates();
                $data['positions']=$this->common_model->get_all_records('electoral_positions');
                $this->load->view('vote_view',$data );
            }  else {
             $this->load->view('confirm_vote_view');    
            }
        }  else {
         $this->load->view('confirm_vote_view');    
        }
       
        // echo $this->generateRandomString(7);
    }

    function number_check($num) {
        $this->load->model('common_model');
        $voter = $this->common_model->find_in_db('voters', 'phone', $num);
        $voter= $voter[0];
        if ($voter === FALSE) {
            $this->form_validation->set_message('number_check', 'This number is not registered to vote');
            return FALSE;
        } elseif ($this->common_model->hasVotedForAll($voter->voter_id)) {
            $this->form_validation->set_message('number_check', 'Sorry, You have already voted for all positions ');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    function vote_submit($voter_id)
    {
        //get all electoral positions
        $positions=$this->common_model->get_all_records('electoral_positions');
        //initialize the candidates picked
        $selected_candidates = array();
        /**loop over all the electoral positions
         then... to the candidates picked array, add the position id of the current electoral position
            as index and the candidate picked as the value 
            i.e $selected_candidates[electoral_positions]=$selected_candidate from the form.
            if the voter has not picked a candidate for the electoral position, it will be false **/
        foreach ($positions as $position) { 
            $selected_candidates[$position->position_id]=$this->input->post('position-'.$position->position_id);
        }

        $data=[];
        //loop through the selected candidates, checking if  the voter has voted for the position and save who they voted for
        foreach ($selected_candidates as $position_id => $candidate_id) {
            //check whether the current position is voted for in the form and the database
           if($candidate_id[0] && !$this->common_model->hasVoted($voter_id,$position_id)){
            $data=array(
                'voter_id'=>$voter_id,
                'candidate_id'=>$candidate_id[0],
                'position_id'=>$position_id

            );
            $this->common_model->insert_data('votes', $data);
            
            }
        }
        $num=$this->input->post('phone');//
                $voter = $this->common_model->find_in_db('voters', 'voter_id', $voter_id);
                $data['voter']=$voter[0];
                $data['candidates']=  $this->common_model->getcandidates();
                $data['positions']=$this->common_model->get_all_records('electoral_positions');
          $data['hasvoted']=$this->common_model->hasVotedForAll($voter_id);
        $this->load->view('vote_view',$data);
    }

    function assert_confirmation($code) {
        $this->load->model('common_model');
        $voter = $this->common_model->find_in_db('voters', 'phone', $this->input->post('phone'));
        if ($voter === FALSE) {
            $this->form_validation->set_message('assert_confirmation', 'This is not a registered number');
            return FALSE;
        } elseif ($voter[0]->confirmation_code!==$code) {
            $this->form_validation->set_message('assert_confirmation', 'Sorry, Your Confirmation Code does not match what we sent');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
    public function voters_who_voted()
    {
        $voters_voted= $this->common_model->getVotersWhoVoted();
         header('Content-Type: application/json');
         echo json_encode($voters_voted);
    }

}