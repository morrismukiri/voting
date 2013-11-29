<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @property flexi_auth $flexi_auth
 * @property common_model $common_model common_model
 */
class user extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->auth = new stdClass;
        $this->load->library('flexi_auth');
        $this->load->model('users');
        
    }

    public function index() {
        if ($this->flexi_auth->is_logged_in()) {
            redirect('main');
        } else {
            $this->login();
        }
    }

    function login() {
        $this->form_validation->set_rules('identity', 'Username or Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('remember', 'Remember Me', '');
        $this->form_validation->set_error_delimiters('<span class="help-block text-error">', '</span>');
        if ($this->input->post() && $this->form_validation->run()) {
            $identity = $this->input->post('identity');
            $password = $this->input->post('password');
            $remember = $this->input->post('remember');
            if ($this->flexi_auth->login($identity, $password, $remember)) {
                redirect('main');
            } else {
                $this->flexi_auth->set_error_message('Incorrect username/password combination', 'public', TRUE);
                //$this->flexi_auth->set_error_message('Incorrect username/password combination');
                $this->load->view('login');
            }
        } else {
            $this->load->view('login');
        }
    }

    function logout() {
        $this->flexi_auth->logout();
        $this->load->view('login');
    }

    function signup() {

        $this->form_validation->set_rules('full_name', 'Full Name', '');
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[12]|callback_username_available'); //is_unique[user_accounts.uacc_username]
        $this->form_validation->set_rules('reg_password', 'Password', 'required|validate_password|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_available'); //is_unique[user_accounts.uacc_email]
        $this->form_validation->set_error_delimiters('<span class="help error">', '</span>');
        $this->form_validation->set_error_delimiters('<span class="help-block text-error">', '</span>');

        if ($this->input->post() && $this->form_validation->run()) {
            $email = $this->input->post('email');
            $username = $this->input->post('username');
            $password = $this->input->post('reg_password');
            $user_data = FALSE;
            $group_id = FALSE;
            $activate = TRUE;
            $this->flexi_auth->insert_user($email, $username, $password, $user_data, $group_id, $activate);
            $this->flexi_auth->login($username, $password, TRUE);
        } else {
            $data['tab'] = 'signup';
            $this->load->view('login', $data);
        }
    }

    function iforgot() {
        if ($this->input->post()) {
            $forgot_accont = $this->input->post('forgot_accont');
            if ($this->common_model->find_in_db('uacc_accounts', 'uacc_email', $forgot_accont) or $this->common_model->find_in_db('uacc_accounts', 'uacc_username', $forgot_accont)) {
                $this->flexi_auth->forgotten_password($forgot_accont);
            }
        } else {
            $this->load->view('iforgot');
        }
    }
    function reset($uid,$token) {
        if($this->flexi_auth->validate_forgotten_password($uid, $token)){
            $this->flexi_auth->forgotten_password_complete($uid, $token, $new_password);
        }
    }

    function username_available($username) {
        if ($this->flexi_auth->username_available($username)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('username_available', "Sorry the username $username has already been taken");
            return FALSE;
        }
    }

    function email_available($email) {
        if ($this->flexi_auth->email_available($email)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('email_available', "Sorry the email address $email has already been registerd to another account");
            return FALSE;
        }
    }

}
