<?php

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->model('user_model');
    }

    public function index()
    {
        $email = $this->input->post("email");
        $password = $this->input->post("password");

        $this->form_validation->set_rules("email", "Email", "required");
        $this->form_validation->set_rules("password", "Password", "required");

        if ($this->form_validation->run()) {
            $user = $this->user_model->get_user($email, $password);
            if (count($user) > 0) {
                $userData = array('id_user' => $user[0]->id_user, 'name' => $user[0]->name);
                $this->session->set_userdata($userData);
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Login success!</div>');

                redirect("/");
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Email or password is incorrect!</div>');
                redirect('/login');
            }
        }

        $this->load->view('login');
    }
}