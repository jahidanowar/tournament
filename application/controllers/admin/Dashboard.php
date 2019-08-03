<?php
class Dashboard extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->not_loggedin();
        $this->check_admin();
    }

    function index(){
        $data = array(
            'page'  =>  'dashboard',
            'title' =>  'Dashboard'
        );
        $this->render_admin_page($data);
    }
}