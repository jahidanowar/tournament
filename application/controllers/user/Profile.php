<?php

class Profile extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->not_loggedin();
        $this->load->model('User_model', 'um');
        $this->load->model('Tournament_model', 'tm');
        $this->load->model('Entry_model', 'em');
    }

    public function index(){
        $new_data = array();

        $user_data = $this->um->get($this->session->userdata('id'));
        $my_entries = $this->em->get_by_user($this->session->userdata('id'));

        foreach($my_entries as $k => $v){
            $new_data[$k] = $v;
            $new_data[$k]['tournament_data'] = $this->tm->get($v['tournament_id']);
        }

        // print_r($my_entries);
        $data = array(
            'page'      =>  'profile',
            'title'     =>  'Profile',
            'not_loggedin' => $this->session->userdata('id'),
            'entries'   =>  $new_data,
            'user_data'    => $user_data
        );
        $this->render_page($data);
    }
}