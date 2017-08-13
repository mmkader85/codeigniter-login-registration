<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Start
 */
class Start extends CI_Controller
{

    /**
     * Start constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->model('audit_model');
    }

    public function index()
    {
        $this->load->view('start');
    }

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

        $data = array('id_user' => '', 'name' => '', 'user_email' => '');
        $this->session->unset_userdata($data);
        $this->session->sess_destroy();

        redirect('/start/logoutflash');
    }

    public function logoutflash()
    {
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">You have been logged out!</div>');

        redirect('/');
    }
}
