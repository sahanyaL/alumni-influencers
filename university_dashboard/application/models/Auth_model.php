<?php
class Auth_model extends CI_Model {

    public function verify_login($email, $password) {
        // Fetch user by email
        $query = $this->db->get_where('dashboard_users', array('email' => $email));
        $user = $query->row();

        // If user exists, verify the Bcrypt password
        if ($user && password_verify($password, $user->password_hash)) {
            return $user;
        }
        
        return FALSE; // Login failed
    }
}