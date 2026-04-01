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
    public function get_user_by_email($email) {
        $query = $this->db->get_where('users', array('email' => $email));
        return $query->row(); 
    }
    public function get_user_by_token($token) {
        return $this->db->get_where('users', array('verification_token' => $token))->row();
    }

    public function update_user($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }
}