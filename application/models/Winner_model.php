<?php

class Winner_model extends CI_Model{

    function check_winner($entry_id,$tournament_id,$user_id,$rank){
        $this->db->where('tournament_id', $tournament_id);
        $this->db->get->where('entry_id', $entry_id);
        $query = $this->db->get('winner');
    }
    function insert($data){
        return $this->db->insert('winners',$data);
    }
    function check_entry_id($id){
        $this->db->where('entry_id', $id);
        $query = $this->db->get('winners');
        if($query->num_rows()>0){
            return false;
        }
        else{
            return true;
        }
    }
    function check_tournament_id($id){
        $this->db->where('tournament_id', $id);
        $query = $this->db->get('winners');
        if($query->num_rows()>3){
            return false;
        }
        else{
            return true;
        }
    }

    function get($id=null){
        if($id != null){
            $this->db->where('entry_id', $id);
            $query = $this->db->get('winners');
            return $query->result_array();
        }
    }
    function get_by_tournament($id=null){
        if($id != null){
            $this->db->where('tournament_id', $id);
            $query = $this->db->get('winners');
            return $query->result_array();
        }
    }
    
}