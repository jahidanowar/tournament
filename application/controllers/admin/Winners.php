<?php
class Winners extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->not_loggedin();
        $this->check_admin();
        $this->load->model('Winner_model', 'wm');
        $this->load->model('Entry_model', 'em');
        $this->load->model('Tournament_model', 'tm');
    }

    function index(){

        $winner_data = $this->wm->get();
        
        //binding winner data with entry data and tournament data
        $new_data = array(); 
        foreach($winner_data as $k => $v){
            $new_data[$k] = $v;
            $new_data[$k]['tournament_data'] = $this->tm->get($v['tournament_id']);
            $new_data[$k]['entry_data'] = $this->em->get($v['entry_id']); 
        }
        header('Content-Type: application/json');
        echo json_encode($new_data);
        // $data = array(
        //     'page'  =>  'pages/winner',
        //     'title' =>  'Manage Winner'
        // );
        // $this->render_admin_page($data);
    }
}