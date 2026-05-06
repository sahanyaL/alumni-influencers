<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();


        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");

        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            exit;
        }
        
        if ($this->uri->segment(2) === 'docs' || $this->uri->segment(2) === 'get_certification_trends') {
            return; 
        }

        $this->load->model('Marketplace_model');
        $this->output->set_content_type('application/json');

        $auth_header = $this->input->get_request_header('Authorization', TRUE);
        
        if (!$auth_header) {
            $headers = apache_request_headers();
            $auth_header = isset($headers['Authorization']) ? $headers['Authorization'] : null;
        }

        if (!$auth_header || !preg_match('/Bearer\s(\S+)/', $auth_header, $matches)) {
            $this->output->set_status_header(401);
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized: Missing Bearer Token']);
            die();
        }

        $token = $matches[1];
        $key_record = $this->db->get_where('api_keys', ['token' => $token, 'is_active' => 1])->row();

        if (!$key_record) {
            $this->output->set_status_header(403);
            echo json_encode(['status' => 'error', 'message' => 'Invalid or Revoked API Key']);
            die();
        }

        $this->db->insert('api_logs', [
            'api_key_id' => $key_record->id,
            'endpoint'   => $this->uri->uri_string(),
            'ip_address' => $this->input->ip_address()
        ]);
    }

    public function featured_alumnus() {
        $winner = $this->Marketplace_model->get_top_bidders(1);

        if (!empty($winner)) {
            $alumnus = $winner[0];
            
            $response = [
                'status' => 'success',
                'data' => [
                    'id' => $alumnus->user_id,
                    'name' => $alumnus->full_name,
                    'image_url' => base_url('uploads/profiles/' . ($alumnus->profile_image ? $alumnus->profile_image : 'default.png')),
                    'bid_amount' => $alumnus->amount,
                    'profile_link' => base_url('index.php/home/view_profile/' . $alumnus->user_id)
                ],
                'timestamp' => date('Y-m-d H:i:s')
            ];
            
            echo json_encode($response);
        } else {
            $this->output->set_status_header(404);
            echo json_encode(['status' => 'error', 'message' => 'No featured alumnus found for today.']);
        }
    }
    public function docs() {
        $this->load->view('api_docs');
    }
    public function get_certification_trends() {
        // 1. Set headers so the dashboard is allowed to read this data (CORS)
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');

        // 2. Query the database using your exact column name 'cert_name'
        $this->db->select('cert_name as label, COUNT(id) as count');
        $this->db->from('certifications');
        $this->db->group_by('cert_name');
        $this->db->order_by('count', 'DESC');
        $this->db->limit(5); 
        
        $query = $this->db->get();

        // 3. Output the result as raw JSON
        echo json_encode($query->result());
    }
}