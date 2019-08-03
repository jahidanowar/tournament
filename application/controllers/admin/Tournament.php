<?php
class Tournament extends My_Controller{
    function __construct(){
        parent::__construct();
        $this->not_loggedin();
        $this->check_admin();
        $this->load->model('Tournament_model', 'tm');
    }

    public function index(){
        $data =  array(
            'page'  =>  'pages/manage_tournament',
            'title' =>  'Manage Tournament',
            'tournament_data' => $this->tm->get()
        );

        $this->render_admin_page($data);
    }

    public function create(){

        $data =  array(
            'page'  =>  'pages/add_tournament',
            'title' =>  'Create Tournament',
            'winning_prize' => $this->tm->get_winning_prize_all()
        );
        $this->render_admin_page($data);
    }

    public function validate(){

        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('type', 'Type', 'trim|required');
        $this->form_validation->set_rules('expiry', 'Expiry Date', 'trim|required');
        $this->form_validation->set_rules('entry_fees', 'Entry Fees', 'trim|required|numeric');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        $this->form_validation->set_rules('event_time', 'Event Time', 'trim|required');
        $this->form_validation->set_rules('venue', 'Venue', 'trim|required');
        $this->form_validation->set_rules('maximum_entries', 'Maximum Entries', 'trim|numeric|required');
        $this->form_validation->set_rules('winning_prize', 'Winning Prize', 'trim|required');
        
        if($this->form_validation->run()){
            $slug = url_title($this->input->post('title'), 'dash', TRUE);
            $data = array(
                'title'         =>  $this->input->post('title'),
                'slug'          =>  $slug,
                'description'   =>  $this->input->post('description'),
                'entry_fee'     =>  $this->input->post('entry_fees'),
                'expiry'        =>  $this->input->post('expiry'),
                'venue'         =>  $this->input->post('venue'),
                'event_time'    =>  $this->input->post('event_time'),
                'maximum_entries'   =>  $this->input->post('maximum_entries'),
                'winning_prize_id'  =>  $this->input->post('winning_prize'),
                'status'        =>  "active",
                'type'          =>  $this->input->post('type'),
                
            );
            $result = $this->tm->insert($data);
            if($result){
                $this->session->set_flashdata('success', 'Tournament has been Created!');
                redirect('admin/tournament/create');
            }
            else{
                $this->session->set_flashdata('error', 'Some thing went wrong try again. Error Code'.$result);
                redirect('admin/tournament/create');
            }
        }
        else{
            $this->create();
        }
    }

    public function edit($id){
        $tournament_data = $this->tm->get($id);

        if($tournament_data){

            $data = array(
                'page'  =>  'pages/edit_tournament',
                'title' =>  'Edit Tournament',
                'tournament_data'   =>  $tournament_data,
            );
            $this->render_admin_page($data);
        }
    }

    public function update(){

        $data = array(
            'title' => $this->input->post('title'),
            'description'   =>  $this->input->post('description'),
            'entry_fee'     =>  $this->input->post('entry_fees'),
            'expiry'        =>  $this->input->post('expiry'),
            'venue'         =>  $this->input->post('venue'),
            'event_time'    =>  $this->input->post('event_time'),
            'type'          =>  $this->input->post('type'),
            
        );

        $result = $this->tm->update($this->input->post('id'),$data);
        if($result){
            $this->session->set_flashdata('success', 'Tournament has been Updated!');
            redirect('admin/tournament/');
        }
        else{
            $this->session->set_flashdata('error', 'Some thing went wrong try again. Error Code'.$result);
            redirect('admin/tournament/');
        }
    }

}