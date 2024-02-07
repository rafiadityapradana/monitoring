<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'Server';
$route['404_override'] = '';
$route['translate_uri_dashes'] = false;
$route['login'] = 'Auth';
$route['app/data-grafik'] = 'Server/dataGrafik';
$route['app/data-monitoring'] = 'Server/dataMonitoring';
$route['app/data-users'] = 'Server/dataUsers';
$route['app/data-machine'] = 'Server/dataMachine';
$route['app/data-server'] = 'Server/dataServer';

/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/
$route['api/auth/login'] = 'api/AuthApi/login';
$route['api/auth/data'] = 'api/AuthApi/data';
$route['api/monitoring'] = 'api/MonitoringApi';
$route['api/monitoring/data'] = 'api/MonitoringApi/dataMoniotring';
$route['api/monitoring/grafik'] = 'api/MonitoringApi/linelimit';
$route['api/monitoring/grafikline'] = 'api/MonitoringApi/grafikLine';
$route['api/data-server'] = 'api/MonitoringApi/dataServer';
$route['api/data-mechine'] = 'api/MonitoringApi/dataMechine';
$route['api/data-users'] = 'api/MonitoringApi/dataUser';