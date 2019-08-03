<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Controller extends CI_Controller{

    function not_loggedin(){
        if(!$this->session->userdata('id')){
            redirect('auth/login');
        }
    }

    function check_admin(){
        $this->load->model('User_model');
        $userdata = $this->User_model->get($this->session->userdata('id'));

        if($userdata['role'] != 'admin'){
            // echo "You Do not have permission to access this page";
            show_error("You do not have permission to access this page.", 403, $heading = 'Access Denied !!');
        }
    }

    public function render_page($data=null){

        $this->load->view('templates/header');
		$this->load->view('templates/navbar',$data);
		$this->load->view('pages/'.$data['page']);
        $this->load->view('templates/footer');
        
    }

    public function render_admin_page($data=null){
        
        $this->load->view('admin/templates/header',$data);
		$this->load->view('admin/templates/sidebar_menu',$data);
		$this->load->view('admin/templates/header_menu',$data);
		$this->load->view('admin/'.$data['page'], $data);
        $this->load->view('admin/templates/footer',$data);
        
    }
}