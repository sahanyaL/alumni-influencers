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
    public function search() {
        $search_query = $this->input->get('q');
        $this->load->model('Marketplace_model');

        if (!empty($search_query)) {
            $data['results'] = $this->Marketplace_model->search_alumni($search_query);
            $data['query'] = $search_query;
        } else {
            $data['results'] = array();
            $data['query'] = "";
        }

        $this->load->view('search_results_view', $data);
    }
}