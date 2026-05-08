<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model'); 
    }

    public function register() {
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]|callback_domain_check');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
    $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

    if ($this->form_validation->run() == FALSE) {
        $this->load->view('auth/register');
    } else {
        $token = bin2hex(random_bytes(16));
        $data = array(
            'email' => $this->input->post('email'),
            'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
            'verification_token' => $token,
            'token_expiry' => date('Y-m-d H:i:s', strtotime('+24 hours')), 
            'is_verified' => 0
        );

        if ($this->User_model->register_user($data)) {
            // Load the email library
            $this->load->library('email'); 
            
            $this->email->from('admin@alumnimarketplace.com', 'Alumni Influencers Portal');
            $this->email->to($this->input->post('email')); 
            $this->email->subject('Verify Your Alumni Account');

            $verify_link = base_url('index.php/auth/verify/' . $token); 
            
            $message = "<div style='font-family: Arial, sans-serif; padding: 20px; border: 1px solid #ddd; border-radius: 8px; max-width: 500px;'>";
            $message .= "<h2 style='color: #0d6efd;'>Welcome to the Alumni Portal!</h2>";
            $message .= "<p>Your profile has been created. Please click the secure link below to verify your academic credentials.</p>";
            $message .= "<p><em>Note: For security reasons, this link will expire in exactly 24 hours.</em></p>";
            $message .= "<br><br>";
            $message .= "<a href='{$verify_link}' style='background-color: #0d6efd; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; font-weight: bold;'>Verify My Account</a>";
            $message .= "</div>";

            $this->email->message($message);

            // ==========================================
            // DEBUGGER INJECTION START
            // ==========================================
            if ($this->email->send()) {
                $this->session->set_flashdata('success', 'Registration successful! Please check your email.');
                redirect('auth/login');
            } else {
                // If it fails, STOP EVERYTHING and show the error log
                echo "<h1>Email Failed to Send</h1>";
                echo "<p>CodeIgniter tried to send to: " . $this->input->post('email') . "</p>";
                echo "<pre>" . $this->email->print_debugger() . "</pre>";
                die(); 
            }
            // ==========================================
            // DEBUGGER INJECTION END
            // ==========================================
        }
    }
}

    public function domain_check($email) {
        // 1. Extract just the domain part (gets "gmail.com" from "test@gmail.com")
        $email_parts = explode('@', $email);
        $domain = end($email_parts);

        // 2. Read the allowed domains from the .env file
        $env_path = FCPATH . '.env';
        if (file_exists($env_path)) {
            $env = parse_ini_file($env_path);
            $allowed_domains = explode(',', $env['ALLOWED_DOMAINS']);
            
            // Clean up any accidental spaces from the .env file
            $allowed_domains = array_map('trim', $allowed_domains);

            // 3. Check if the user's domain is in the VIP list
            if (in_array($domain, $allowed_domains)) {
                return TRUE;
            }
        } else {
            if ($domain === 'westminster.ac.uk') {
                return TRUE;
            }
        }

        $this->form_validation->set_message('domain_check', 'Please use a valid University email address.');
        return FALSE;
    }

    public function login() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $user = $this->User_model->get_user_by_email($email);
            if ($user && password_verify($password, $user->password)) {
                
                if ($user->is_verified == 0) {
                    $this->session->set_flashdata('error', 'Your account is not verified. Please check your email.');
                    redirect('auth/login');
                    return; 
                }
                $session_data = array(
                    'user_id'   => $user->id,
                    'email'     => $user->email,
                    'role'      => $user->role,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($session_data);
                
                if ($user->role === 'admin') {
                    redirect('admin/dashboard');
                } else {
                    redirect('profile/dashboard');
                }
            } else {
                $this->session->set_flashdata('error', 'Invalid Email or Password');
                redirect('auth/login');
            }
        }
    }
    public function verify($token = NULL) {
        if ($token == NULL) {
            show_404();
        }
        $user = $this->User_model->get_user_by_token($token);

        if ($user) {
            $data = array('is_verified' => 1, 'verification_token' => NULL);
            
            if ($this->User_model->update_user($user->id, $data)) {
                $this->session->set_flashdata('success', 'Email verified successfully! You can now log in.');
                redirect('auth/login');
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid or expired verification link.');
            redirect('auth/login');
        }
    }
    public function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', 'You have been logged out successfully.');
    
        redirect('auth/login');
    }
}