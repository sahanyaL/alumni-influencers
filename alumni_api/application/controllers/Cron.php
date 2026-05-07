<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $ip = $this->input->ip_address();
        if ($ip !== '127.0.0.1' && $ip !== '::1') {
            show_error('Direct access forbidden. This is a system script.', 403);
        }
    }

    public function run_midnight_selection() {
        // 1. CLEAR THE BOARD: Remove yesterday's winner
        $this->db->update('profiles', ['is_featured' => 0]);

        // Get today's date (Format: YYYY-MM-DD)
        $today = date('Y-m-d');

        // 2. FIND THE WINNER: Get the highest bidder FROM TODAY ONLY
        $this->db->select('user_id, amount');
        $this->db->from('bids');
        $this->db->like('bid_time', $today, 'after'); // Only matches bids from today!
        $this->db->order_by('amount', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        $winner = $query->row();

        if ($winner) {
            // 3. CROWN THE NEW WINNER
            $this->db->where('user_id', $winner->user_id);
            $this->db->set('is_featured', 1);
            $this->db->set('appearance_count', 'appearance_count + 1', FALSE); 
            $this->db->update('profiles');

            echo "CRON SUCCESS: User ID " . $winner->user_id . " is the new Alumni of the Day!";
        } else {
            echo "CRON SUCCESS: No bids found for today. Board cleared.";
        }
    }
}