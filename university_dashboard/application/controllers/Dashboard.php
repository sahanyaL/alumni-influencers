<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // SECURITY REQUIREMENT: Kick out anyone who isn't logged in
        if(!$this->session->userdata('admin_logged_in')) {
            $this->session->set_flashdata('error', 'You must be logged in to view analytics.');
            redirect('Auth');
        }
    }

    public function index() {
        // Prepare the data array to send to the view
        $data['admin_email'] = $this->session->userdata('email');
        
        // Load the UI skeleton
        $this->load->view('dashboard_view', $data);
    }
}