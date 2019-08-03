<?php

class User_model extends CI_Model{
    
    function get($id){
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        $data = $query->row_array();
        unset($data['password']);
        unset($data['verification_key']);
        return $data;
    }
    function get_all(){
        $query = $this->db->get('users');
        return $query->result_array();
    }
}