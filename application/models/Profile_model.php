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
    public function get_certifications($user_id) {
        return $this->db->get_where('certifications', array('user_id' => $user_id))->result();
    }

    public function get_licences($user_id) {
        return $this->db->get_where('licences', array('user_id' => $user_id))->result();
    }

    public function insert_certification($data) {
        return $this->db->insert('certifications', $data);
    }

    public function insert_licence($data) {
        return $this->db->insert('licences', $data);
    }
    public function get_employment($user_id) {
        return $this->db->get_where('employment', array('user_id' => $user_id))->result();
    }

    public function insert_employment($data) {
        return $this->db->insert('employment', $data);
    }
}