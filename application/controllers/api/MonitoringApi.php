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
class MonitoringApi extends REST_Controller
{
    function __construct()
    {
        // Construct the parent class
        parent::__Construct();
    }

    public function index_get()
    {
        try {
            $this->response(
                $this->MonitoringModel->GetMonitoringFromLocalServer(
                    $this->get('draw'),
                    $this->get('start'),
                    $this->get('length'),
                    $this->get('order'),
                    $this->get('serverId'),
                    $this->get('mechineId')
                ),
                REST_Controller::HTTP_OK
            );
        } catch (Exception $th) {
            //throw $th;
            $this->response(
                ['message' => 'An Error Occurred While Load Data'],
                REST_Controller::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
    public function index_post()
    {
        try {
            if ($this->post('data') != false) {
                if (
                    $this->MonitoringModel->InsertMonitoringFromLocalServer(
                        $this->post('data')
                    )
                ) {
                    $this->response(
                        ['message' => 'Success Saving Data'],
                        REST_Controller::HTTP_CREATED
                    ); // CREATED (201) being the HTTP response code
                } else {
                    $this->response(
                        ['message' => 'An Error Occurred While Saving Data'],
                        REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                    );
                }
            } else {
                $this->response(
                    ['message' => 'An Error Occurred While Saving Data'],
                    REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                );
            }
        } catch (Exception $th) {
            //throw $th;
            $this->response(
                ['message' => 'An Error Occurred While Saving Data'],
                REST_Controller::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
    public function linelimit_get()
    {
        try {
            $this->response(
                $this->MonitoringModel->GetMonitoringFromLocalServerlinelimit(),
                REST_Controller::HTTP_OK
            );
        } catch (Exception $th) {
            //throw $th;
            $this->response(
                ['message' => 'An Error Occurred While Load Data'],
                REST_Controller::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
    public function grafikLine_get()
    {
        try {
            $this->response(
                $this->MonitoringModel->GetMonitoringServerline(
                    $this->get('type'),
                    $this->get('serverId'),
                    $this->get('mechineId'),
                    $this->get('from'),
                    $this->get('to')
                ),
                REST_Controller::HTTP_OK
            );
        } catch (Exception $th) {
            //throw $th;
            $this->response(
                ['message' => 'An Error Occurred While Load Data'],
                REST_Controller::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
    // /api/monitoring
    public function dataServer_get()
    {
        try {
            $this->response(
                $this->MonitoringModel->GetDataServer(
                    $this->get('draw'),
                    $this->get('start'),
                    $this->get('length'),
                    $this->get('search'),
                    $this->get('order')
                ),
                REST_Controller::HTTP_OK
            );
        } catch (Exception $th) {
            //throw $th;
            $this->response(
                ['message' => 'An Error Occurred While Load Data'],
                REST_Controller::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
    public function dataServer_post()
    {
        try {
            if ($this->MonitoringModel->InsertDataServer($this->post())) {
                $this->response(
                    ['message' => 'Successfully saved data'],
                    REST_Controller::HTTP_CREATED
                );
            } else {
                $this->response(
                    ['message' => 'An Error Occurred While Saving Data'],
                    REST_Controller::HTTP_BAD_REQUEST
                );
            }
        } catch (Exception $th) {
            //throw $th;
            $this->response(
                ['message' => 'An Error Occurred While Saving Data'],
                REST_Controller::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
    public function dataMechine_get()
    {
        try {
            $this->response(
                $this->MonitoringModel->GetMechine(
                    $this->get('draw'),
                    $this->get('start'),
                    $this->get('length'),
                    $this->get('search'),
                    $this->get('order')
                ),
                REST_Controller::HTTP_OK
            );
        } catch (Exception $th) {
            //throw $th;
            $this->response(
                ['message' => 'An Error Occurred While Load Data'],
                REST_Controller::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    function dataUser_get()
    {
        try {
            $this->response(
                $this->MonitoringModel->GetUser(
                    $this->get('draw'),
                    $this->get('start'),
                    $this->get('length'),
                    $this->get('search'),
                    $this->get('order')
                ),
                REST_Controller::HTTP_OK
            );
        } catch (Exception $th) {
            //throw $th;
            $this->response(
                ['message' => 'An Error Occurred While Load Data'],
                REST_Controller::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
    function dataRoole_get(){
        try {
            $this->response(
                $this->MonitoringModel->GetRole(
                    $this->get('draw'),
                    $this->get('start'),
                    $this->get('length'),
                    $this->get('search'),
                    $this->get('order')
                ),
                REST_Controller::HTTP_OK
            );
        } catch (Exception $th) {
            //throw $th;
            $this->response(
                ['message' => 'An Error Occurred While Load Data'],
                REST_Controller::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    function dataMoniotring_get()
    {
        try {
            if ($this->get() != null) {
                if ($this->get('mechineId') == null) {
                    $this->response(
                        [
                            'message' =>
                                'An Error Occurred While Load Data - Param mechineId required',
                            'status' => false,
                            'data' => null,
                        ],
                        REST_Controller::HTTP_BAD_REQUEST
                    );
                } elseif ($this->get('group') == null) {
                    $this->response(
                        [
                            'message' =>
                                'An Error Occurred While Load Data - Param group required',
                            'status' => false,
                            'data' => null,
                        ],
                        REST_Controller::HTTP_BAD_REQUEST
                    );
                } elseif ($this->get('timeStart') == null) {
                    $this->response(
                        [
                            'message' =>
                                'An Error Occurred While Load Data - Param timeStart required',
                            'status' => false,
                            'data' => null,
                        ],
                        REST_Controller::HTTP_BAD_REQUEST
                    );
                } elseif ($this->get('timeEnd') == null) {
                    $this->response(
                        [
                            'message' =>
                                'An Error Occurred While Load Data - Param timeEnd required',
                            'status' => false,
                            'data' => null,
                        ],
                        REST_Controller::HTTP_BAD_REQUEST
                    );
                } elseif (
                    !$this->validateDate($this->get('timeStart')) &&
                    !$this->validateDate($this->get('timeStart'))
                ) {
                    $this->response(
                        [
                            'message' =>
                                'An Error Occurred While Load Data - Date Format Not Valid Y-m-d H:i:s',
                            'status' => false,
                            'data' => null,
                        ],
                        REST_Controller::HTTP_BAD_REQUEST
                    );
                } else {
                    $this->response(
                        $this->MonitoringModel->MonitoringDataServer(
                            $this->get()
                        ),
                        REST_Controller::HTTP_OK
                    );
                }
            } else {
                $this->response(
                    [
                        'message' => 'An Error Occurred While Load Data',
                        'status' => false,
                        'data' => null,
                    ],
                    REST_Controller::HTTP_OK
                );
            }
        } catch (Exception $th) {
            //throw $th;
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
    function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
}