<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
    }

    public function index() {
        if($this->session->userdata('admin_logged_in')) {
            redirect('Dashboard');
        }
        $this->load->view('login_view');
    }

    public function do_login() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        if (strpos($email, '@westminster.ac.uk') === false) {
            $this->session->set_flashdata('error', 'Must use a valid university email domain.');
            redirect('Auth');
        }

        $user = $this->Auth_model->verify_login($email, $password);

        if ($user) {
            $session_data = array(
                'admin_id' => $user->id,
                'email' => $user->email,
                'admin_logged_in' => TRUE,
                'dashboard_api_token' => 'YOUR_READ_ANALYTICS_TOKEN_HERE' 
            );
            $this->session->set_userdata($session_data);
            redirect('Dashboard'); 
        } else {
            $this->session->set_flashdata('error', 'Invalid email or password.');
            redirect('Auth');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('Auth');
    }
}