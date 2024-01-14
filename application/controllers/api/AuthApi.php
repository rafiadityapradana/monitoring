<?php

defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class AuthApi extends REST_Controller
{
    function __construct()
    {
        // Construct the parent class
        parent::__Construct();
    }
    public function index_get()
    {
        try {
            $data = $this->MonitoringModel->AuthData();
            if ($data['status']) {
                $this->response($data, REST_Controller::HTTP_CREATED);
            } else {
                $this->response($data, REST_Controller::HTTP_BAD_REQUEST);
            }
        } catch (Exception $th) {
            //throw $th;
            var_dump($th);
            die();
            $this->response(
                [
                    'message' => 'An Error Occurred While Load Data',
                    'status' => false,
                    'data' => null,
                ],
                REST_Controller::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
    public function login_post()
    {
        try {
            if ($this->post() != null) {
                if ($this->post('username') == null) {
                    $this->response(
                        [
                            'message' => 'Username Required',
                            'status' => false,
                            'data' => null,
                        ],
                        REST_Controller::HTTP_BAD_REQUEST
                    );
                }
                if ($this->post('password') == null) {
                    $this->response(
                        [
                            'message' => 'Password Required',
                            'status' => false,
                            'data' => null,
                        ],
                        REST_Controller::HTTP_BAD_REQUEST
                    );
                }

                if ($this->post('agent') == null) {
                    $this->response(
                        [
                            'message' => 'User agent Required',
                            'status' => false,
                            'data' => null,
                        ],
                        REST_Controller::HTTP_BAD_REQUEST
                    );
                }
                if ($this->post('ip') == null) {
                    $this->response(
                        [
                            'message' => 'Ip Required',
                            'status' => false,
                            'data' => null,
                        ],
                        REST_Controller::HTTP_BAD_REQUEST
                    );
                }
                $data = $this->MonitoringModel->AuthLogin($this->post());
                if ($data['status']) {
                    $this->response($data, REST_Controller::HTTP_CREATED);
                } else {
                    $this->response($data, REST_Controller::HTTP_BAD_REQUEST);
                }
                // CREATED (201) being the HTTP response code
            } else {
                $this->response(
                    [
                        'message' => 'incorrect username or password',
                        'status' => false,
                        'data' => null,
                    ],
                    REST_Controller::HTTP_BAD_REQUEST
                );
            }
        } catch (Exception $th) {
            //throw $th;
            $this->response(
                ['message' => $th],
                REST_Controller::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
