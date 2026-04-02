<?php
class Profile_model extends CI_Model {

    public function get_profile($user_id) {
        return $this->db->get_where('profiles', array('user_id' => $user_id))->row();
    }

    public function get_degrees($user_id) {
        return $this->db->get_where('degrees', array('user_id' => $user_id))->result();
    }

    public function update_profile($user_id, $data) {
        $this->db->where('user_id', $user_id);
        return $this->db->update('profiles', $data);
    }
    public function insert_degree($data) {
        return $this->db->insert('degrees', $data);
    }
}