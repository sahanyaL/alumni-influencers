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

    public function register() {
        // Enforce the university domain requirement
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]|callback_domain_check');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('register_view'); 
        } else {
            $token = bin2hex(random_bytes(16)); // Secure token generation
            $data = array(
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT), // Bcrypt hashing
                'role' => 'pending_staff', // Default role for security
                'verification_token' => $token,
                'is_verified' => 0
            );

            if ($this->Auth_model->register_user($data)) {
                $this->send_verification_email($data['email'], $token);
                $this->session->set_flashdata('success', 'Registration successful! Please verify your email.');
                redirect('Auth');
            }
        }
    }

    // --- NEW VERIFICATION METHOD ---
    public function verify($token = NULL) {
        if (!$token) show_404();
        
        $user = $this->Auth_model->get_user_by_token($token);
        if ($user) {
            $this->Auth_model->verify_user($user->id);
            $this->session->set_flashdata('success', 'Email verified! Please wait for admin approval.');
            redirect('Auth');
        } else {
            $this->session->set_flashdata('error', 'Invalid or expired token.');
            redirect('Auth');
        }
    }

    private function send_verification_email($email, $token) {
    $this->load->library('email');
    
    // Set headers to ensure HTML rendering
    $this->email->set_mailtype("html");
    
    $this->email->from('systems@westminster.ac.uk', 'University Intelligence');
    $this->email->to($email);
    $this->email->subject('Verify Dashboard Access');
    
    $link = base_url('index.php/Auth/verify/' . $token);

    // Build the professional HTML message
    $message = "<div style='font-family: Arial, sans-serif; padding: 20px; border: 1px solid #ddd; border-radius: 8px; max-width: 500px;'>";
    $message .= "<h2 style='color: #212529;'>University Intelligence Dashboard</h2>";
    $message .= "<p>A request has been made to access the University Analytics platform using this email address.</p>";
    $message .= "<p>Please click the button below to verify your identity and request staff-level access.</p>";
    $message .= "<br>";
    $message .= "<a href='{$link}' style='background-color: #0d6efd; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;'>Verify Dashboard Access</a>";
    $message .= "<br><br>";
    $message .= "<p style='font-size: 12px; color: #666;'>If you did not request this, please ignore this email.</p>";
    $message .= "</div>";

    $this->email->message($message);
    $this->email->send();
}

    public function domain_check($email) {
        if (strpos($email, '@westminster.ac.uk') !== false) {
            return TRUE;
        }
        $this->form_validation->set_message('domain_check', 'Must use @westminster.ac.uk domain.');
        return FALSE;
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