<?php
class Tournament_model extends CI_Model{
    function insert($data){
        return $this->db->insert('tournament', $data);
        // return $this->db->insert_id();
    }

    function get($id=NULL,$active=NULL){

        if($id != NULL){
            $this->db->where('id', $id);
            if($active == TRUE){
                $this->db->where('status', 'active');  
            }  
            $query = $this->db->get('tournament');
            return $query->row_array();
        }
        if($active == TRUE){
            $this->db->where('status', 'active');  
        }      
        $query = $this->db->get('tournament');
        return $query->result_array();
    }

    function get_by_slug($slug,$active=null){
        $this->db->where('slug', $slug);
        if($active == TRUE){
            $this->db->where('status', 'active');  
        } 
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