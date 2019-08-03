<?php
class Tournament_model extends CI_Model{
    function insert($data){
        return $this->db->insert('tournament', $data);
        // return $this->db->insert_id();
    }

    function get($id=NULL){

        if($id != NULL){
            $this->db->where('id', $id);
            $query = $this->db->get('tournament');
            return $query->row_array();
        }
        
        $query = $this->db->get('tournament');
        return $query->result_array();
    }

    function get_by_slug($slug){
        $this->db->where('slug', $slug);
        $query = $this->db->get('tournament');
        return $query->row_array();
    }

    function get_winning_prize($id){
        $this->db->where('id', $id);
        $query = $this->db->get('winning_prize');
        return $query->row_array();
    }
    function get_winning_prize_all(){
        $query = $this->db->get('winning_prize');
        return $query->result_array();
    }

    function update($id,$data){
        $this->db->where('id', $id);
        return $this->db->update('tournament', $data);
    }
}