<?php

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('user_model');
    }

    function index()
    {
        $this->form_validation->set_rules(
            'email',
            'Email',
            'trim|required|valid_email|is_unique[users.email]',
            array(
                'is_unique' => 'Email address already exists.'
            )
        );
        $this->form_validation->set_rules('password', 'Password', 'trim|required|md5');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|md5|matches[password]');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('contact_no', 'Contact No', 'trim|required');

        if ($this->form_validation->run()) {
            $data = array(
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'name' => $this->input->post('name'),
                'contact_no' => $this->input->post('contact_no'),
            );

            if ($this->user_model->insert_user($data)) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Successfully Registered!</div>');

                redirect('/');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Failed to register. Please try later!</div>');
            }
        }

        $this->load->view('register');
    }
}