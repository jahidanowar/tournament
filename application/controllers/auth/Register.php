<?php
class Register extends My_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('encryption');
    }

    public function index(){
        $data = array(
            'page'      =>  'register',
            'title'     =>  'Register',
            'not_loggedin' => $this->session->userdata('id')
        );
        $this->render_page($data);
    }

    public function validate(){

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|trim|numeric');
        $this->form_validation->set_rules('username', 'PUBG Username', 'required|trim|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('password_confirmation', 'Password Confirmation', 'required|trim|matches[password]');

        if($this->form_validation->run()){

            $verification_key = md5(rand());
            $encrypted_password = $this->encryption->encrypt($this->input->post('password_confirmation'));

            $data = array(
                'name'              =>  $this->input->post('name'),
                'email'             =>  $this->input->post('email'),
                'phone'             =>  $this->input->post('phone'),
                'username'          =>  $this->input->post('username'),
                'password'          =>  $encrypted_password,
                'role'              => 'customer',
                'verification_key'  =>  $verification_key,
                'status'            => 'registerd'
            );

            $id = $this->Auth_model->insert($data);

            if($id>0){
                $this->session->set_flashdata('success', 'You have successfully registered. You can Login Now');
                redirect('auth/login');
            }
        }
        else{
            $this->index();
        }

    }
}