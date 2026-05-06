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
        $this->db->select('bids.user_id, users.email, bids.amount, bids.bid_time, profiles.full_name, profiles.profile_image');
        $this->db->from('bids');
        $this->db->join('users', 'users.id = bids.user_id');
        $this->db->join('profiles', 'profiles.user_id = bids.user_id');
        $this->db->order_by('bids.amount', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    public function search_alumni($query) {
        $this->db->select('profiles.user_id, profiles.full_name, profiles.bio');
        $this->db->from('profiles');
        
        $this->db->join('degrees', 'degrees.user_id = profiles.user_id', 'left');
        $this->db->join('employment', 'employment.user_id = profiles.user_id', 'left');

        $this->db->group_start();
            $this->db->like('profiles.full_name', $query);
            $this->db->or_like('profiles.bio', $query);
            $this->db->or_like('degrees.degree_name', $query);
            $this->db->or_like('employment.job_title', $query);
        $this->db->group_end();

        $this->db->distinct();
        return $this->db->get()->result();
    }

    public function reset_bidding_cycle() {
        $top_3 = $this->get_top_bidders(3);

        if (!empty($top_3)) {
            foreach ($top_3 as $winner) {
                $this->db->set('appearance_count', 'appearance_count + 1', FALSE);
                $this->db->where('user_id', $winner->user_id);
                $this->db->update('profiles');
            }
        }
        return $this->db->empty_table('bids');
    }
}