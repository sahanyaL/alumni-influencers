<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        $this->load->library('form_validation');
        
        $this->load->model('Profile_model');
    }

    public function dashboard() {
        $user_id = $this->session->userdata('user_id');
        
        $data['profile'] = $this->Profile_model->get_profile($user_id);
        $data['degrees'] = $this->Profile_model->get_degrees($user_id);
        $data['certifications'] = $this->Profile_model->get_certifications($user_id);
        $data['licences'] = $this->Profile_model->get_licences($user_id);
        
        $this->load->view('profile/dashboard', $data);
    }
    
    public function edit() {
        $user_id = $this->session->userdata('user_id');
        $data['profile'] = $this->Profile_model->get_profile($user_id);
        
        $this->load->view('profile/edit', $data);
    }

    public function update() {
        $user_id = $this->session->userdata('user_id');

        $this->form_validation->set_rules('full_name', 'Full Name', 'required');
        $this->form_validation->set_rules('bio', 'Biography', 'required');
        $this->form_validation->set_rules('linkedin_url', 'LinkedIn URL', 'required|valid_url');

        if ($this->form_validation->run() == FALSE) {
            $this->edit();
        } else {
            $update_data = array(
                'full_name' => $this->input->post('full_name'),
                'bio' => $this->input->post('bio'),
                'linkedin_url' => $this->input->post('linkedin_url')
            );

            if ($this->Profile_model->update_profile($user_id, $update_data)) {
                $this->session->set_flashdata('success', 'Profile updated successfully!');
                redirect('profile/dashboard');
            }
        }
    }

    public function add_degree() {
        $this->form_validation->set_rules('degree_name', 'Degree Name', 'required');
        $this->form_validation->set_rules('university_url', 'University URL', 'required|valid_url');
        $this->form_validation->set_rules('completion_date', 'Completion Date', 'required');

        if ($this->form_validation->run() == TRUE) {
            $degree_data = array(
                'user_id' => $this->session->userdata('user_id'),
                'degree_name' => $this->input->post('degree_name'),
                'university_url' => $this->input->post('university_url'),
                'completion_date' => $this->input->post('completion_date')
            );
            
            $this->load->model('Profile_model');
            $this->Profile_model->insert_degree($degree_data);
            redirect('profile/dashboard');
        }
    }
    public function add_certification() {
        $this->form_validation->set_rules('cert_name', 'Certification Name', 'required');
        $this->form_validation->set_rules('course_url', 'Course URL', 'required|valid_url');
        $this->form_validation->set_rules('completion_date', 'Completion Date', 'required');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'cert_name' => $this->input->post('cert_name'),
                'course_url' => $this->input->post('course_url'),
                'completion_date' => $this->input->post('completion_date')
            );
            $this->Profile_model->insert_certification($data);
            redirect('profile/dashboard');
        }
    }

    public function add_licence() {
        $this->form_validation->set_rules('licence_name', 'Licence Name', 'required');
        $this->form_validation->set_rules('awarding_body_url', 'Awarding Body URL', 'required|valid_url');
        $this->form_validation->set_rules('completion_date', 'Completion Date', 'required');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'licence_name' => $this->input->post('licence_name'),
                'awarding_body_url' => $this->input->post('awarding_body_url'),
                'completion_date' => $this->input->post('completion_date')
            );
            $this->Profile_model->insert_licence($data);
            redirect('profile/dashboard');
        }
    }
}