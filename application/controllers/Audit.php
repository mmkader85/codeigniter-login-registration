<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Audit.
 *
 * This controller serves the registration and login history page.
 */
class Audit extends CI_Controller
{
    /**
     * Audit constructor.
     *
     * Initialize the database, loads the pagination library and audit model.
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->library('pagination');
        $this->load->model('audit_model');
    }

    /**
     * Default function.
     *
     * Retrieve the registration and login history of the logged-in user from the database
     * based on the session. Present the history in a tabular form with pagination.
     */
    function index()
    {
        $userId = $this->session->userdata('id_user');
        if (!$userId) {
            redirect('/');
        }

        $data = [];
        $resultsPerPage = 5;
        $currentPageNo = $this->input->get('per_page');
        $resultsCount = $this->audit_model->get_audit_count_by_id_user($userId);

        $config['base_url'] = '/audit';
        $config['per_page'] = $resultsPerPage;
        $config['total_rows'] = $resultsCount;

        $this->pagination->initialize($config);
        $data['paginationLinks'] = $this->pagination->create_links();

        $audits = $this->audit_model->get_audit_by_id_user($userId, $currentPageNo, $resultsPerPage);
        $data['audits'] = $audits;

        $this->load->view('audit', $data);
    }
}