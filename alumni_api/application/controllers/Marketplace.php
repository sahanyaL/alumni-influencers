<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marketplace extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        $this->load->library('form_validation');
        $this->load->model('Marketplace_model');
    }

    public function index() {
        $data['top_bids'] = $this->Marketplace_model->get_top_bidders(3);
        $this->load->view('marketplace/bid_view', $data);
    }

    public function place_bid() {
        $this->form_validation->set_rules('amount', 'Bid Amount', 'required|numeric|greater_than[0]');

        if ($this->form_validation->run() == TRUE) {
            $user_id = $this->session->userdata('user_id');
            $appearance_count = $this->Marketplace_model->get_appearance_count($user_id);
            
            if ($appearance_count >= 3) {
                $this->session->set_flashdata('error', 'You have reached your 3-win limit and cannot bid further.');
            } else {
                $bid_data = array(
                    'user_id' => $user_id,
                    'amount' => $this->input->post('amount'),
                    'bid_time' => date('Y-m-d H:i:s')
                );
                $this->Marketplace_model->insert_bid($bid_data);
                $this->session->set_flashdata('success', 'Bid placed successfully!');
            }
            redirect('marketplace');
        }
    }
}