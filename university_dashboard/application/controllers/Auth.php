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

        // This checks the shared database for the user
        $user = $this->Auth_model->verify_login($email, $password);

        // SECURITY CHECK: Do they exist AND are they a staff member?
        if ($user && isset($user->role) && $user->role === 'staff') {
            
            $session_data = array(
                'admin_id' => $user->id,
                'email' => $user->email,
                'admin_logged_in' => TRUE,
                'dashboard_api_token' => 'YOUR_READ_ANALYTICS_TOKEN_HERE' 
            );
            $this->session->set_userdata($session_data);
            redirect('Dashboard'); 
            
        } elseif ($user && $user->role !== 'staff') {
            // Block normal alumni or developers from accessing the dashboard
            $this->session->set_flashdata('error', 'Access Denied: You do not have Staff privileges.');
            redirect('Auth');
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