<?php
class Marketplace_model extends CI_Model {

    public function insert_bid($data) {
        return $this->db->insert('bids', $data);
    }

    public function get_appearance_count($user_id) {
        $this->db->select('appearance_count');
        $query = $this->db->get_where('profiles', array('user_id' => $user_id));
        return $query->row()->appearance_count;
    }

    public function get_top_bidders($limit = 3) {
        $this->db->select('users.email, bids.amount, bids.bid_time, profiles.full_name');
        $this->db->from('bids');
        $this->db->join('users', 'users.id = bids.user_id');
        $this->db->join('profiles', 'profiles.user_id = bids.user_id');
        $this->db->order_by('bids.amount', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
}