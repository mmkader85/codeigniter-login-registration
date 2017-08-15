<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Start.
 *
 * This is the default controller of this application. It serves the landing page and logout operation.
 */
class Start extends CI_Controller
{

    /**
     * Start constructor.
     *
     * Initialize the database, loads the myredis library and audit model.
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->library('myredis');
        $this->load->model('audit_model');
    }

    /**
     * Default function.
     *
     * Renders the landing page view.
     */
    public function index()
    {
        $this->load->view('start');
    }

    /**
     * Logout function.
     *
     * Destroys the user session and redirects the control over to logoutflash function to setup the logout
     * flash message for the user.
     * Records the logout user's ID in the Redis storage.
     */
    public function logout()
    {
        $userId = $this->session->userdata('id_user');
        if (!$userId) {
            redirect('/');
        }

        $auditData = [
            'type' => AUDIT_LOGOUT,
            'id_user' => $userId,
            'ip_address' => $this->input->ip_address()
        ];
        $this->audit_model->save_audit($auditData);

        /*
         * Record all logout user's ID in Redis
         */
        $redis = $this->myredis->get_instance();
        $redis->rpush('LOGOUT_USERS', $userId);

        $data = array('id_user' => '', 'name' => '', 'user_email' => '');
        $this->session->unset_userdata($data);
        $this->session->sess_destroy();

        redirect('/start/logoutflash');
    }

    /**
     * Logoutflash function.
     *
     * Setup the logout flash message for the user and redirects the user to landing page.
     */
    public function logoutflash()
    {
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">You have been logged out!</div>');

        redirect('/');
    }
}
