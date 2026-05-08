<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function verify_login($email, $password) {
        $this->db->select('id, email, password, role, is_verified');
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        $user = $query->row();

        if ($user && password_verify($password, $user->password)) {
            // Requirement: Secure login with verification check
            if ($user->is_verified == 1) {
                return $user;
            }
        }
        return FALSE;
    }

    //Registration Logic for CW2 ---
    public function register_user($data) {
        // Requirement: Email-based registration 
        // This inserts into the shared 'users' table used by both CW1 and CW2
        return $this->db->insert('users', $data);
    }

    // Secure Token Handling ---
    public function get_user_by_token($token) {
        // Requirement: Secure token generation and verification 
        $this->db->where('verification_token', $token);
        $query = $this->db->get('users');
        return $query->row();
    }

    // Update Verification Status ---
    public function verify_user($id) {
        // Requirement: Email verification system
        $data = array(
            'is_verified' => 1,
            'verification_token' => NULL // Clear token after single use for security 
        );
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }
}