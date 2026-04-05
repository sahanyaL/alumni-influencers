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

    public function manage_api() {
    // 1. Fetch all keys and the emails of users they belong to [cite: 215]
    $data['api_keys'] = $this->db->select('api_keys.*, users.email')
                             ->from('api_keys')
                             ->join('users', 'users.id = api_keys.user_id')
                             ->get()->result();

    // 2. Fetch the usage statistics (last 20 entries) [cite: 125, 214]
    $data['logs'] = $this->db->order_by('accessed_at', 'DESC')
                             ->limit(20)
                             ->get('api_logs')->result();

    $this->load->view('admin/manage_api', $data);
}

    public function generate_key() {
        $new_token = bin2hex(random_bytes(16)); 
        
        $this->db->insert('api_keys', [
            'user_id' => $this->session->userdata('user_id'),
            'token'   => $new_token,
            'label'   => 'AR Client - ' . date('Y-m-d'),
            'is_active' => 1
        ]);
        
        redirect('admin/manage_api');
    }

    public function revoke_key($id) {
        $this->db->update('api_keys', ['is_active' => 0], ['id' => $id]);
        redirect('admin/manage_api');
    }
}