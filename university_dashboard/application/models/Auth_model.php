<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function verify_login($email, $password) {
        
        // 1. Grab the user data. Notice we are explicitly asking for the 'role' here!
        $this->db->select('id, email, password, role, is_verified');
        $this->db->where('email', $email);
        
        // 2. Check the main 'users' table (the same one CW1 uses)
        $query = $this->db->get('users');
        $user = $query->row();

        // 3. If the user exists, verify their hashed password
        if ($user && password_verify($password, $user->password)) {
            
            // 4. Double check that they actually clicked the verification link in their email
            if ($user->is_verified == 1) {
                return $user; // Success! Return the user (including their 'staff' role)
            }
        }

        // If they don't exist, password fails, or they aren't verified, return false.
        return FALSE;
    }
}