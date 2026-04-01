<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model'); 
    }

    public function register() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]|callback_domain_check');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/register');
        } else {
            $data = array(
                'email' => $this->input->post('email'),
                'password_hash' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'verification_token' => bin2hex(random_bytes(16)),
                'is_verified' => 0
            );

            if ($this->User_model->register_user($data)) {
                $this->session->set_flashdata('success', 'Registration successful! Please verify your email.');
                redirect('auth/login');
            }
        }
    }

    public function domain_check($email) {
        $allowed_domain = '@westminster.ac.uk';
        if (strpos($email, $allowed_domain) !== false) {
            return TRUE;
        } else {
            $this->form_validation->set_message('domain_check', 'Please use a valid university email address.');
            return FALSE;
        }
    }
}