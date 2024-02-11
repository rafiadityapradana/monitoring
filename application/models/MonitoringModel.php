<?php

defined('BASEPATH') or exit('No direct script access allowed');
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
class MonitoringModel extends CI_Model
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }
    function Login()
    {
        $this->db->where(
            'USERNAME',
            htmlspecialchars($this->input->post('username'))
        );
        $data = $this->db->get('user_monitoring')->row();
        if ($data || $data != null) {
            if (
                password_verify(
                    htmlspecialchars($this->input->post('password')),
                    $data->PASSWORD
                )
            ) {
                $this->session->set_userdata(['USER_ID' => $data->USER_ID]);
                Redirect('');
            }
        }

        Redirect('auth');
    }
    function LogoutModel()
    {
        $this->session->sess_destroy();
        Redirect('auth');
    }
    function AuthLogin($input)
    {
        $key =
            '19$m=65536,t=4,p=1$ZXUwL0JNTEhtdDY4NC8yZg$W4a2Ba71EYR2s8UtU1G8whl9cHssxNwk1+eQKrWaQ4Y';
        $this->db->where(
            'user_monitoring.USERNAME',
            htmlspecialchars($input['username'])
        );
        $this->db->join(
            'mechine',
            'mechine.MECHINE_ID = user_monitoring.USERNAME'
        );
        $data = $this->db->get('user_monitoring')->row();
        if ($data || $data != null) {
            if (!password_verify($input['password'], $data->PASSWORD)) {
                return [
                    'message' => 'incorrect username or password',
                    'status' => false,
                    'data' => null,
                ];
            }

            $issuedAt = time();
            // jwt valid for 60 days (60 seconds * 60 minutes * 24 hours * 60 days)
            $expirationTime = $issuedAt * 60 * 24 * 60;
            $expirationTimeRef = 60 + 60 * $issuedAt * 60 * 24 * 60;
            $accessToken = JWT::encode(
                [
                    'sub' => $data->USER_ID,
                    'iat' => $issuedAt,
                    'exp' => $expirationTime,
                ],
                $key,
                'HS256'
            );

            $refreshToken = JWT::encode(
                [
                    'sub' => [
                        'userId' => $data->USER_ID,
                        'ip' => htmlspecialchars($input['ip']),
                        'agent' => htmlspecialchars($input['agent']),
                    ],
                    'iat' => $issuedAt,
                    'exp' => $expirationTimeRef,
                ],
                $key,
                'HS256'
            );
            return [
                'message' => 'Login Successfully',
                'status' => true,
                'data' => [
                    'accessToken' => $accessToken,
                    'refreshToken' => $refreshToken,
                ],
            ];
        }
        return [
            'message' => 'incorrect username or password',
            'status' => false,
            'data' => null,
        ];
    }
    function getAuthorizationHeader()
    {
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER['Authorization']);
        } elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            //Nginx or fast CGI
            $headers = trim($_SERVER['HTTP_AUTHORIZATION']);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(
                array_map('ucwords', array_keys($requestHeaders)),
                array_values($requestHeaders)
            );
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }
    function getBearerToken()
    {
        $headers = $this->getAuthorizationHeader();
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }
    function AuthData()
    {
        $key =
            '19$m=65536,t=4,p=1$ZXUwL0JNTEhtdDY4NC8yZg$W4a2Ba71EYR2s8UtU1G8whl9cHssxNwk1+eQKrWaQ4Y';
        $Token = $this->getBearerToken();
        if ($Token != null) {
            try {
                $decoded = JWT::decode($Token, new Key($key, 'HS256'));
                $this->db->where(
                    'user_monitoring.USER_ID',
                    htmlspecialchars($decoded->sub)
                );
                $this->db->join(
                    'mechine',
                    'mechine.MECHINE_ID = user_monitoring.USERNAME'
                );
                $data = $this->db->get('user_monitoring')->row();
                $res = [
                    'userId' => $data->USER_ID,
                    'mechineId' => $data->MECHINE_ID,
                    'mechineName' => $data->MECHINE_NAME,
                    'createdAt' => $data->CREATED_AT,
                    'updatedAt' => $data->UPDATED_AT,
                    // 'ip' => $decoded->ip,
                    // 'agent' => $decoded->decoded,
                ];
                return [
                    'message' => 'Successfully Retrieving Data',
                    'status' => true,
                    'data' => $res,
                ];
            } catch (\Firebase\JWT\ExpiredException $exception) {
                return [
                    'message' => 'An Error Occurred While Load Data',
                    'status' => false,
                    'data' => null,
                ];
            }
        }
        return [
            'message' => 'An Error Occurred While Load Data',
            'status' => false,
            'data' => null,
        ];
    }
    function InsertMonitoringFromLocalServer($data)
    {
        // $this->db->query('')
        //    return false;
        $options = [
            'cluster' => 'ap1',
            'useTLS' => true,
        ];
        $pusher = new Pusher\Pusher(
            '353ffd743a6c256848cc',
            '737ae04e5a518e23c20c',
            '1673478',
            $options
        );

        $toDb = [];
        $event = [];
        $Arg = json_decode($data, true);
        foreach ($Arg as $post) {
            array_push($toDb, [
                'MONITORING_ID' => $post['monitoringId'],
                'SERVER_ID' => $post['serverId'],
                'MECHINE_ID' => $post['machineId'],
                'VOLTAGE' => $post['voltage'],
                'CURRENT' => $post['current'],
                'POWER' => $post['power'],
                'FACTOR' => $post['factor'],
                'VA' => $post['va'],
                'VAR' => $post['var'],
                'FREKUENSI' => $post['frekuensi'],
                'ENERGI' => $post['energi'],
                'CREATED_AT' => $post['createdAt'],
                'UPDATED_AT' => $post['updatedAt'],
            ]);
            array_push($event, [
                'xKeys' => $post['createdAt'],
                'volt' => (float) $post['voltage'],
                'ampere' => (float) $post['current'], //'7',
                'frekuensi' => (float) $post['frekuensi'], // '4',
                'watt' => (float) $post['factor'], //'4',
                'kwh' => (float) $post['energi'], //'4',
                'va' => (float) $post['va'],
                'var' => (float) $post['var'],
                'powerFactor' => (float) $post['power'], // '3',
            ]);
        }

        //    return true;
        //    die();
        if ($this->db->insert_batch('monitoring', $toDb)) {
            $pusher->trigger('my-channel', 'server-event', [
                'labels' => [
                    'volt',
                    'ampere',
                    'frekuensi',
                    'watt',
                    'kwh',
                    'va',
                    'var',
                    'power factor',
                ],
                'lineColors' => [
                    '#04BFDA',
                    '#FFA84A',
                    '#41E308',
                    '#EBEF14',
                    '#FF4A4A',
                    '#4E95FF',
                    '#FB4EFF',
                    '#4EEAFF',
                ],
                'data' => $event,
            ]);
            return true;
        } else {
            return false;
        }
    }

    function GetServerDopDown()
    {
        return $this->db->get('server')->result();
    }
    function GetmechineDopDown()
    {
        return $this->db->get('mechine')->result();
    }
    function GetMonitoringFromLocalServer(
        $draw,
        $start,
        $length,
        $order,
        $serverId,
        $mechineId
    ) {
        $this->db->select(
            'A.MONITORING_ID, C.SERVER_NAME,B.MECHINE_NAME, A.VOLTAGE, A.CURRENT,   A.POWER, A.FACTOR, A.VA, A.VAR, A.FREKUENSI, A.ENERGI, A.CREATED_AT'
        );
        $this->db->from('monitoring A');
        $this->db->join('mechine B', 'B.MECHINE_ID = A.MECHINE_ID');
        $this->db->join('server C', 'C.SERVER_ID = A.SERVER_ID');
        $this->db->order_by('CREATED_AT', $order[0]['dir']);

        if ($serverId != null || $serverId != '') {
            $this->db->where('A.SERVER_ID', $serverId);
        }

        if ($mechineId != null || $mechineId != '') {
            $this->db->where('A.MECHINE_ID', $mechineId);
        }
        $this->db->limit($length, $start);
        $data = $this->db->get()->result();
        return [
            'recordsTotal' => $this->CountMonitoring($serverId, $mechineId),
            'draw' => $draw,
            'recordsFiltered' => $this->CountMonitoring($serverId, $mechineId),
            'data' => $data,
        ];
    }

    function CountMonitoring($serverId, $mechineId)
    {
        $this->db->from('monitoring A');
        $this->db->join('mechine B', 'B.MECHINE_ID = A.MECHINE_ID');
        $this->db->join('server C', 'C.SERVER_ID = A.SERVER_ID');
        if ($serverId != null || $serverId != '') {
            $this->db->where('A.SERVER_ID', $serverId);
        }

        if ($mechineId != null || $mechineId != '') {
            $this->db->where('A.MECHINE_ID', $mechineId);
        }
        return $this->db->count_all_results();
    }
    function GetMonitoringFromLocalServerlinelimit()
    {
        $this->db->limit(6, 0);
        $this->db->order_by('CREATED_AT', 'DESC');
        $data = $this->db->get('monitoring')->result_array();
        $event = [];
        foreach ($data as $key) {
            array_push($event, [
                'xKeys' => $key['CREATED_AT'],
                'volt' => (float) $key['VOLTAGE'],
                'ampere' => (float) $key['CURRENT'], //'7',
                'frekuensi' => (float) $key['FREKUENSI'], // '4',
                'watt' => (float) $key['FACTOR'], //'4',
                'kwh' => (float) $key['ENERGI'], //'4',
                'va' => (float) $key['VA'],
                'var' => (float) $key['VAR'],
                'powerFactor' => (float) $key['POWER'], // '3',
            ]);
        }

        return [
            'labels' => [
                'volt',
                'ampere',
                'frekuensi',
                'watt',
                'kwh',
                'va',
                'var',
                'power factor',
            ],
            'lineColors' => [
                '#04BFDA',
                '#FFA84A',
                '#41E308',
                '#EBEF14',
                '#FF4A4A',
                '#4E95FF',
                '#FB4EFF',
                '#4EEAFF',
            ],
            'data' => $event,
        ];
    }
    function GetUser($draw, $start, $length, $search, $order)
    {
        $this->db->limit($length, $start);
        $this->db->order_by('CREATED_AT', $order[0]['dir']);
        $data = $this->db->get('user_monitoring')->result();
        $totalData = $this->db->count_all_results('user_monitoring');
        if ($search['value'] != null || $search['value'] != '') {
            $this->db->like('USERNAME', $search['value']);

            $this->db->limit($length, $start);
            $data = $this->db->get('user_monitoring')->result();
        }
        if ($search['value'] != null || $search['value'] != '') {
            $this->db->like('USERNAME', $search['value']);
            $this->db->limit($length, $start);
            $totalData = $this->db->count_all_results('user_monitoring');
        }
        return [
            'recordsTotal' => $totalData,
            'draw' => $draw,
            'recordsFiltered' => $totalData,
            'data' => $data,
        ];
    }

    function GetDataServer($draw, $start, $length, $search, $order)
    {
        $this->db->limit($length, $start);
        $this->db->order_by('CREATED_AT', $order[0]['dir']);

        $data = $this->db->get('server')->result();
        $totalData = $this->db->count_all_results('server');
        if ($search['value'] != null || $search['value'] != '') {
            $this->db->like('SERVER_NAME', $search['value']);
            // $this->db->like('SERVER_ID', $search['value']);
            $this->db->limit($length, $start);
            $data = $this->db->get('server')->result();
        }
        if ($search['value'] != null || $search['value'] != '') {
            $this->db->like('SERVER_NAME', $search['value']);
            // $this->db->like('SERVER_ID', $search['value']);
            $this->db->limit($length, $start);
            $totalData = $this->db->count_all_results('server');
        }
        return [
            'recordsTotal' => $totalData,
            'draw' => $draw,
            'recordsFiltered' => $totalData,
            'data' => $data,
        ];
    }
    function InsertDataServer($input)
    {
        $data = [
            'SERVER_ID' => 'SYS' . date('Ymdhis'),
            'SERVER_NAME' => htmlspecialchars($input['serverName']),
            'SERVER_ADDRESS' => htmlspecialchars($input['serverAddrss']),
        ];
        if ($this->db->insert('server', $data)) {
            return true;
        }
        return false;
    }

    function GetMechine($draw, $start, $length, $search, $order)
    {
        $this->db->limit($length, $start);
        $this->db->order_by('CREATED_AT', $order[0]['dir']);

        $data = $this->db->get('mechine')->result();
        $totalData = $this->db->count_all_results('mechine');
        if ($search['value'] != null || $search['value'] != '') {
            $this->db->like('MECHINE_ID', $search['value']);
            $this->db->like('MECHINE_NAME', $search['value']);
            $this->db->limit($length, $start);
            $data = $this->db->get('mechine')->result();
        }
        if ($search['value'] != null || $search['value'] != '') {
            $this->db->like('MECHINE_ID', $search['value']);
            $this->db->like('MECHINE_NAME', $search['value']);
            $this->db->limit($length, $start);
            $totalData = $this->db->count_all_results('mechine');
        }
        return [
            'recordsTotal' => $totalData,
            'draw' => $draw,
            'recordsFiltered' => $totalData,
            'data' => $data,
        ];
    }
    function GetMonitoringServerline($type, $serverId, $mechineId, $from, $to)
    {
        // $this->db->limit(6, 0);
        $this->db->select(
            'A.MONITORING_ID, C.SERVER_NAME,B.MECHINE_NAME, A.VOLTAGE, A.CURRENT,   A.POWER, A.FACTOR, A.VA, A.VAR, A.FREKUENSI, A.ENERGI, A.CREATED_AT'
        );
        $this->db->from('monitoring A');
        $this->db->join('mechine B', 'B.MECHINE_ID = A.MECHINE_ID');
        $this->db->join('server C', 'C.SERVER_ID = A.SERVER_ID');
        if ($serverId != null || $serverId != '') {
            $this->db->where('A.SERVER_ID', $serverId);
        }

        if ($mechineId != null || $mechineId != '') {
            $this->db->where('A.MECHINE_ID', $mechineId);
        }

        if (($from != null || $from != '') && ($to != null || $to != '')) {
            $this->db->where('A.CREATED_AT >=', $from);
            $this->db->where('A.CREATED_AT <=', $to);
        }
        $this->db->order_by('A.CREATED_AT', 'ASC');
        $data = $this->db->get()->result_array();
        $event = [];
        switch ($type) {
            case 'volt':
                foreach ($data as $key) {
                    array_push($event, [
                        'xKeys' => $key['CREATED_AT'],
                        'volt' => (float) $key['VOLTAGE'],
                    ]);
                }
                return [
                    'labels' => ['volt'],
                    'lineColors' => ['#04BFDA'],
                    'data' => $event,
                ];
                break;

            case 'ampere':
                foreach ($data as $key) {
                    array_push($event, [
                        'xKeys' => $key['CREATED_AT'],
                        'ampere' => (float) $key['CURRENT'], //'7',
                    ]);
                }
                return [
                    'labels' => ['ampere'],
                    'lineColors' => ['#FFA84A'],
                    'data' => $event,
                ];
                break;
            case 'frekuensi':
                foreach ($data as $key) {
                    array_push($event, [
                        'xKeys' => $key['CREATED_AT'],
                        'frekuensi' => (float) $key['FREKUENSI'], // '4'
                    ]);
                }
                return [
                    'labels' => ['frekuensi'],
                    'lineColors' => ['#41E308'],
                    'data' => $event,
                ];
                break;

            case 'watt':
                foreach ($data as $key) {
                    array_push($event, [
                        'xKeys' => $key['CREATED_AT'],
                        'watt' => (float) $key['POWER'], //'4',
                    ]);
                }
                return [
                    'labels' => ['watt'],
                    'lineColors' => ['#EBEF14'],
                    'data' => $event,
                ];
                break;

            case 'kwh':
                foreach ($data as $key) {
                    array_push($event, [
                        'xKeys' => $key['CREATED_AT'],
                        'watt' => (float) $key['ENERGI'], //'4',
                    ]);
                }
                return [
                    'labels' => ['kwh'],
                    'lineColors' => ['#FF4A4A'],
                    'data' => $event,
                ];
                break;

            case 'va':
                foreach ($data as $key) {
                    array_push($event, [
                        'xKeys' => $key['CREATED_AT'],
                        'va' => (float) $key['VA'],
                    ]);
                }
                return [
                    'labels' => ['va'],
                    'lineColors' => ['#4E95FF'],
                    'data' => $event,
                ];
                break;

            case 'var':
                foreach ($data as $key) {
                    array_push($event, [
                        'xKeys' => $key['CREATED_AT'],
                        'var' => (float) $key['VAR'],
                    ]);
                }
                return [
                    'labels' => ['var'],
                    'lineColors' => ['#FB4EFF'],
                    'data' => $event,
                ];
                break;

            case 'powerFactor':
                foreach ($data as $key) {
                    array_push($event, [
                        'xKeys' => $key['CREATED_AT'],
                        'powerFactor' => (float) $key['FAKTOR'], // '3',
                    ]);
                }
                return [
                    'labels' => ['power'],
                    'lineColors' => ['#4EEAFF'],
                    'data' => $event,
                ];
                break;

            default:
                foreach ($data as $key) {
                    array_push($event, [
                        'xKeys' => $key['CREATED_AT'],
                        'volt' => (float) $key['VOLTAGE'],
                        'ampere' => (float) $key['CURRENT'], //'7',
                        'frekuensi' => (float) $key['FREKUENSI'], // '4',
                        'watt' => (float) $key['FACTOR'], //'4',
                        'kwh' => (float) $key['ENERGI'], //'4',
                        'va' => (float) $key['VA'],
                        'var' => (float) $key['VAR'],
                        'powerFactor' => (float) $key['POWER'], // '3',
                    ]);
                }
                return [
                    'labels' => [
                        'volt',
                        'ampere',
                        'frekuensi',
                        'watt',
                        'kwh',
                        'va',
                        'var',
                        'power factor',
                    ],
                    'lineColors' => [
                        '#04BFDA',
                        '#FFA84A',
                        '#41E308',
                        '#EBEF14',
                        '#FF4A4A',
                        '#4E95FF',
                        '#FB4EFF',
                        '#4EEAFF',
                    ],
                    'data' => $event,
                ];
                break;
        }
    }
    function MonitoringDataServer($get)
    {
        $sql = "SELECT 
        SUM(VOLTAGE) AS VOLTAGE,
        SUM(CURRENT) AS CURRENT,
        SUM(FREKUENSI) AS FREKUENSI,
        SUM(FACTOR) AS FACTOR,
        SUM(POWER) AS POWER,
        SUM(VA) AS VA,
        SUM(VAR) AS VAR,
        sum(ENERGI) AS ENERGI, 
        CREATED_AT
        FROM monitoring ";
        $sql .=
            " WHERE CREATED_AT BETWEEN '" .
            $get['timeStart'] .
            "' AND '" .
            $get['timeEnd'] .
            "' ";

        if ($get['group'] != null) {
            switch ($get['group']) {
                case '1':
                    $sql .= ' GROUP BY TIME(CREATED_AT) ';
                    break;
                case '2':
                    $sql .= ' GROUP BY HOUR(CREATED_AT) ';
                    break;
                case '3':
                    $sql .= ' GROUP BY DATE(CREATED_AT) ';
                    break;

                case '4':
                    $sql .= ' GROUP BY YEAR(CREATED_AT), MONTH(CREATED_AT) ';
                    break;
                case '5':
                    $sql .= ' GROUP BY MONTH(CREATED_AT) ';
                    break;
                case '6':
                    $sql .= ' GROUP BY YEAR(CREATED_AT) ';
                    break;

                default:
                    $sql .= ' GROUP BY TIME(CREATED_AT) ';
                    break;
            }
        }
        if ($get['mechineId'] != null) {
            $sql .= " AND MECHINE_ID = '" . $get['mechineId'] . "'";
        }

        $data = $this->db->query($sql)->result();
        $Volt = [];
        $Frekuensi = [];
        $Ampere = [];
        $Watt = [];
        $Kwh = [];
        $Va = [];
        $Var = [];
        $PowerFactor = [];
        foreach ($data as $key) {
            array_push($Volt, (float) $key->VOLTAGE);
            array_push($Frekuensi, (float) $key->FREKUENSI);
            array_push($Ampere, (float) $key->CURRENT);
            array_push($Watt, (float) $key->FACTOR);
            array_push($Kwh, (float) $key->ENERGI);
            array_push($Va, (float) $key->VA);
            array_push($Var, (float) $key->VAR);
            array_push($PowerFactor, (float) $key->POWER);
        }
        return [
            'message' => 'Successfully Retrieving Data',
            'status' => true,
            'data' => [
                'volt' => $Volt,
                'frekuensi' => $Frekuensi,
                'ampere' => $Ampere,
                'watt' => $Watt,
                'kwh' => $Kwh,
                'va' => $Va,
                'var' => $Var,
                'powerFactor' => $PowerFactor,
            ],
        ];
    }
}
