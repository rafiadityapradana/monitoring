<?php

defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';
use WebSocket\Client;
class Server extends CI_Controller
{
    function __construct()
    {
        // Construct the parent class

        parent::__construct();
        if (!$this->session->userdata('USER_ID')) {
            Redirect('auth');
        }
    }
    public function index()
    {
        $this->load->view('template/header');
        $this->load->view('dashboard');
        $this->load->view('template/footer');
    }
    function dataMonitoring()
    {
        $data['server'] = $this->MonitoringModel->GetServerDopDown();
        $data['mechine'] = $this->MonitoringModel->GetmechineDopDown();
        $this->load->view('template/header');
        $this->load->view('data_monitoring', $data);
        $this->load->view('template/footer');
    }
    function dataGrafik()
    {
        $data['server'] = $this->MonitoringModel->GetServerDopDown();
        $data['mechine'] = $this->MonitoringModel->GetmechineDopDown();
        $this->load->view('template/header');
        $this->load->view('data_grafik', $data);
        $this->load->view('template/footer');
    }
    function dataUsers()
    {
        $this->load->view('template/header');
        $this->load->view('data_users');
        $this->load->view('template/footer');
        // $this->load->view('rest_server');
    }
    function dataRoles()
    {
        $this->load->view('template/header');
        $this->load->view('data_roles');
        $this->load->view('template/footer');
        // $this->load->view('rest_server');
    }

    function dataMachine()
    {
        $this->load->view('template/header');
        $this->load->view('data_machine');
        $this->load->view('template/footer');
    }
    function dataServer()
    {
        $this->load->view('template/header');
        $this->load->view('data_server');
        $this->load->view('template/footer');
    }
    function logout()
    {
        $this->MonitoringModel->LogoutModel();
    }
}