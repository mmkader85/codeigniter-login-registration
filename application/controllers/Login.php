<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Login.
 *
 * This controller serves the login process.
 */
class Login extends CI_Controller
{
    /**
     * Login constructor.
     *
     * Initialize the database, loads the user model and audit model.
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->model('user_model');
        $this->load->model('audit_model');
    }

    /**
     * Default function.
     *
     * Gets the user's email and password in the login form and authorizes the credentials.
     * Once authorizes successfully, creates the session for the user.
     * Both successful and failed authorizations are recorded in database.
     */
    public function index()
    {
        $email = $this->input->post("email");
        $password = $this->input->post("password");

        $this->form_validation->set_rules("email", "Email", "required");
        $this->form_validation->set_rules("password", "Password", "required");

        if ($this->form_validation->run()) {

            $user = $this->user_model->get_user($email, $password);
            $userId = $user[0]->id_user;
            $userName = $user[0]->name;

            if (count($user) > 0) {
                $userData = [
                    'id_user' => $userId,
                    'name' => $userName,
                    'user_email' => $email
                ];
                $this->session->set_userdata($userData);
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Login success!</div>');

                $auditData = [
                    'type' => AUDIT_LOGIN_SUCCESS,
                    'id_user' => $userId,
                    'ip_address' => $this->input->ip_address()
                ];
                $this->audit_model->save_audit($auditData);

                redirect("/");
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Email or password is incorrect!</div>');

                $auditData = [
                    'type' => AUDIT_LOGIN_FAILED,
                    'user_email' => $email,
                    'ip_address' => $this->input->ip_address()
                ];
                $this->audit_model->save_audit($auditData);

                redirect('/login');
            }
        }

        $this->load->view('login');
    }
}