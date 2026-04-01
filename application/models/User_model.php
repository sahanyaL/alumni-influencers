<?php
class User_model extends CI_Model {

    public function register_user($user_data) {
        $this->db->trans_start(); 
        $this->db->insert('users', $user_data);
        $user_id = $this->db->insert_id(); 

        $profile_data = array(
            'user_id' => $user_id,
            'full_name' => '', 
            'appearance_count' => 0
        );
        $this->db->insert('profiles', $profile_data);

        $this->db->trans_complete();

        return $this->db->trans_status();
    }
}