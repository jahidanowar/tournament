<?php

class Entry_model extends CI_Model{

    function insert($data){
        $this->db->insert('entries',$data);
        return $this->db->insert_id();
    }
    function get($id){
        $this->db->where('id', $id);
        $this->db->where('transaction_status', 1);
        $query = $this->db->get('entries');
        return $query->row_array();
    }
    function get_by_user($id){
        $this->db->where('user_id', $id);
        $this->db->where('transaction_status', 1);
        $query = $this->db->get('entries');
        return $query->result_array();
    }
    function get_by_tournament($id){
        $this->db->where('transaction_status', 1);
        $this->db->where('tournament_id', $id);
        $query = $this->db->get('entries');
        return $query->result_array();
    }

    function get_by_user_torunament($uid, $tid){
        $this->db->where('user_id', $uid);
        $this->db->where('tournament_id', $tid);
        $this->db->where('transaction_status', 1);
        $query = $this->db->get('entries');
        
        if($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    function update($id, $data){
        $this->db->where('id', $id);
        return $this->db->update('entries', $data);
    }
    function delete($id){
        $this->db->where('id', $id);
        return $this->db->delete('entries');
    }

    function select_winner($id,$winners_no){
        $this->db->where('tournament_id', $id);
        // $this->db->select_max('points');
        $this->db->order_by('points', 'DESC');
        $this->db->limit($winners_no);
        $query = $this->db->get('entries');
        return $query->result_array();
    }
}