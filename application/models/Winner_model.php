<?php

class Winner_model extends CI_Model{

    function check_winner($entry_id,$tournament_id,$user_id,$rank){
        $this->db->where('tournament_id', $tournament_id);
        $this->db->get->where('entry_id', $entry_id);
        $query = $this->db->get('winner');
    }
}