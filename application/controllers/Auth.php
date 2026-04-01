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

    public function login() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $user = $this->User_model->get_user_by_email($email);

            if ($user && password_verify($password, $user->password_hash)) {
                if ($user->is_verified == 0) {
                    $this->session->set_flashdata('error', 'Please verify your email before logging in.');
                    redirect('auth/login');
                }

                $session_data = array(
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($session_data);

                redirect('profile/dashboard'); 
            } else {
                $this->session->set_flashdata('error', 'Invalid Email or Password');
                redirect('auth/login');
            }
        }
    }
    public function verify($token = NULL) {
        if ($token == NULL) {
            show_404();
        }
        $user = $this->User_model->get_user_by_token($token);

        if ($user) {
            $data = array('is_verified' => 1, 'verification_token' => NULL);
            
            if ($this->User_model->update_user($user->id, $data)) {
                $this->session->set_flashdata('success', 'Email verified successfully! You can now log in.');
                redirect('auth/login');
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid or expired verification link.');
            redirect('auth/login');
        }
    }
}