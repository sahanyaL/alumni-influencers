<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index() {
        $this->load->model('Marketplace_model');

        $data['featured_alumni'] = $this->Marketplace_model->get_top_bidders(3);
        $this->load->view('public_home', $data);
    }
    public function view_profile($user_id) {
        $this->load->model('Profile_model');
        $data['profile'] = $this->Profile_model->get_profile($user_id);
        $data['degrees'] = $this->Profile_model->get_degrees($user_id);
        $data['certifications'] = $this->Profile_model->get_certifications($user_id);
        $data['employment'] = $this->Profile_model->get_employment($user_id);

        if (!$data['profile']) {
            show_404();
        }

        $this->load->view('public_profile_view', $data);
    }
}