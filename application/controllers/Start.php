<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Start extends CI_Controller {

    /*public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'html'));
        $this->load->library('session');
    }*/

    public function index()
    {
        $this->load->view('start');
    }

    public function logout()
    {
        $data = array('login' => '', 'uname' => '', 'uid' => '');
        $this->session->unset_userdata($data);
        $this->session->sess_destroy();
        redirect('start/index');
    }
}
