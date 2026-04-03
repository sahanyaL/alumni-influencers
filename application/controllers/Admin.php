<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        if ($this->session->userdata('role') !== 'admin') {
            $this->session->set_flashdata('error', 'Access Denied: Admins Only.');
            redirect('profile/dashboard');
        }

        $this->load->model('Marketplace_model');
    }

    public function dashboard() {
        $this->load->view('admin/admin_dashboard');
    }

    public function trigger_reset() {
        if($this->Marketplace_model->reset_bidding_cycle()) {
            $this->session->set_flashdata('success', 'Cycle reset! Winners recorded and bids cleared.');
        } else {
            $this->session->set_flashdata('error', 'Reset failed.');
        }
        redirect('admin/dashboard');
    }
}