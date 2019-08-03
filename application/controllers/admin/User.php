<?php
class User extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->not_loggedin();
        $this->check_admin();
        $this->load->model('User_model', 'um');
    }

    public function index(){
        $data = array(
            'page'  =>  'pages/manage_user',
            'title' =>  'Manage Users',
            'user_data' =>  $this->um->get_all()
        );
        $this->render_admin_page($data);
    }
}