<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Register.
 *
 * This controller serves the registration process.
 */
class Register extends CI_Controller
{
    /**
     * Register constructor.
     *
     * Initialize the database, loads the myredis library, user model and audit model.
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->library('myredis');
        $this->load->model('user_model');
        $this->load->model('audit_model');
    }

    /**
     * Default function.
     *
     * Gets the user information in the registration form, validates it and create an account for the user in the database.
     * Records the registered user's details in the Redis storage.
     */
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

            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $contactNo = $this->input->post('contact_no');

            $data = [
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'contact_no' => $contactNo
            ];

            $userId = $this->user_model->save_user($data);

            if ($userId) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Successfully Registered!</div>');

                $auditData = [
                    'type' => AUDIT_REGISTER,
                    'id_user' => $userId,
                    'ip_address' => $this->input->ip_address()
                ];
                $this->audit_model->save_audit($auditData);

                /*
                 * Record all registered user's name, emails in Redis
                 */
                $redis = $this->myredis->get_instance();
                $redis->hset('USER:' . $userId, 'name', $name);
                $redis->hset('USER:' . $userId, 'email', $email);
                $redis->rpush('REG_USERS', $email);

                redirect('/');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Failed to register. Please try later!</div>');
            }
        }

        $this->load->view('register');
    }
}