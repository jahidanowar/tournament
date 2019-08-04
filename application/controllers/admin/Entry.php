<?php
class Entry extends MY_Controller{
    function __construct(){
        parent::__construct();
        // $this->not_loggedin();
        // $this->check_admin();
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
    function get(){
        $id = $this->input->get('id');
        if($id != NULL){
            $entries = $this->em->get_by_tournament($id);
            $tournament_id = NULL;
            foreach($entries as $row){
                $tournament_id = $row['tournament_id'];
            }

            $data = array(
                'entries'   =>  $entries,
                'tournament_data'   =>  $this->tm->get($tournament_id)
            );

            $result = array('data'=>array());

            foreach($data['entries'] as $k => $v){

                $result['data'][$k] = array(
                    $this->wm->get($v['id']) == TRUE ? $v['id']." <i class='fas fa-crown'></i>": $v['id'],
                    "<a href='".base_url('admin/user/view/'.$v['user_id'])."' class='btn btn-sm btn-info'  >View Leader</a>",
                    2 => '',
                    $v['transaction_id'],
                    $v['created_at'],
                    $v['points'] == 0 ? "
                    <a href='#' id='addPoint' class='btn btn-primary' data-entryid='".$v['id']."' data-userid='".$v['user_id']."' data-tournamentid='".$v['tournament_id']."'>Add Point</a>
                    " : $v['points'] ." <a href='#' id='addPoint' class='badge badge-warning' data-entryid='".$v['id']."' data-userid='".$v['user_id']."' data-tournamentid='".$v['tournament_id']."'>Update Point</a>"
                );

                $u_names = array();
                foreach(json_decode($v['usernames']) as $key => $username){
                    $u_names[$key] = "<span class='badge badge-primary'>".$username."</span>";
                }

                $result['data'][$k][2] = implode(',', $u_names);

            }
            
            echo json_encode($result);
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

    function update(){
        $result = array();
        $entry_id = $this->input->post('entry_id');
        $point = $this->input->post('point');

        if(!empty($point) && !empty($entry_id)){
            $data = array(
                'points'=>$point
            );
            
            $response = $this->em->update($entry_id, $data);
            if($response){
                $result['status'] = 'success';
                $result['message'] = 'Points Added to the Entry';
            }
            else{
                $result['status'] = 'error';
                $result['message'] = 'Something Went Wrong';
            }
        }
        else{
            $result['status'] = 'error';
            $result['message'] = 'Enter all The Data';
        }

        echo json_encode($result);
    }

    function select_winner(){
        $result = array();
        $id = $this->input->post('id');
        if(!empty($id)){
            $entries_data = $this->em->select_winner($id,3);

            $i = 0;
            foreach($entries_data as $entry_data){
                $data = array(
                    'entry_id'=>$entry_data['id'],
                    'tournament_id'=>$entry_data['tournament_id'],
                    'rank'=> ++$i,
                    'users'=>$entry_data['usernames']
                );

                if($this->wm->check_entry_id($entry_data['id']) == TRUE && $this->wm->check_tournament_id($entry_data['tournament_id']) == TRUE){
                    $this->wm->insert($data);
                    $result['status'] = 'success';
                    $result['message'] = "Winners has been Generated";
                }
                else{
                    $result['status'] = 'error';
                    $result['message'] = "Winners Already Generated";
                }
            }
            echo json_encode($result);

        }
    }
}