<?php

class Logout extends MY_Controller{
    function index(){
        $data = $this->session->all_userdata();

        foreach($data as $row => $rows_value) {
            $this->session->unset_userdata($row);
        }
        $this->session->set_flashdata('success', 'You have successfully logged out');
        redirect('auth/login');  
    }
}