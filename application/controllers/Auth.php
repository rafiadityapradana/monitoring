<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        if ($this->session->userdata('USER_ID')) {
            Redirect('');
        }
    }
    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('auth');
        } else {
            $this->MonitoringModel->Login();
        }
    }
}
