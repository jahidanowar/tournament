<?php
class Auth_model extends CI_Model{
    function insert($data){
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    function can_login($username, $password){
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        if($query->num_rows()>0){

            foreach($query->result() as $row){
                $store_password = $this->encryption->decrypt($row->password);
                if($store_password == $password){
                    $this->session->set_userdata('id', $row->id);
                }
                else{
                    return 'Wrong Password';
                }
            }
        }
        else{
            return 'User Does not Exists';
        }
    }
}