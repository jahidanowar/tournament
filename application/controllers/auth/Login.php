<?php

class Login extends MY_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('encryption');
        if($this->session->userdata('id')){
            redirect('tournament');
        }
    }

    public function index(){
        $redirect = '';

        if($this->input->get('redirect')){
            $redirect = $this->input->get('redirect');
        }

        $data = array(
            'page'      =>  'login',
            'title'     =>  'Login',
            'not_loggedin' => $this->session->userdata('id'),
            'redirect'     => $redirect
        );

        $this->render_page($data);
    }

    public function validate(){
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if($this->form_validation->run()){
            $result = $this->Auth_model->can_login($this->input->post('username'), $this->input->post('password'));
            if($result == ''){

                if($this->input->post('redirect')){
                    redirect($this->input->post('redirect'));
                }
                else{
                    redirect('/user/profile');
                }
            }
            else{
                $this->session->set_flashdata('error',$result);
                redirect('auth/login');
            }
        }
        else{
            $this->index();
        }
    }
}