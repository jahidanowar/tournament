<?php
class Entry extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->not_loggedin();
        $this->check_admin();
        $this->load->model('Tournament_model', 'tm');
        $this->load->model('Entry_model', 'em');
        $this->load->model('Winner_model', 'wm');
    }

    function view($id=null){
        if($id != NULL){
            $entries = $this->em->get_by_tournament($id);
            $tournament_id = NULL;
            foreach($entries as $row){
                $tournament_id = $row['tournament_id'];
            }

            $data = array(
                'page'      => 'pages/entries',
                'title'     =>  'Entries',
                'entries'   =>  $entries,
                'tournament_data'   =>  $this->tm->get($tournament_id)
            );
            $this->render_admin_page($data);
        }
    }

    function winner_check(){
        $entry_id = $this->input->post('entry_id');
        $tournament_id = $this->input->post('tournament_id');
        $user_id = $this->input->post('user_id');
        $rank = $this->input->post('rank');
        $data = array(
            'status'    =>  true,
            'entry_id'  =>  $entry_id,
            'rank'      =>  $rank
        );

        echo json_encode($data);
    }
}