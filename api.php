<?php
session_start();

require_once 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('main');
$log->pushHandler(new StreamHandler('logs/everything.log', Logger::DEBUG));
$log->pushHandler(new StreamHandler('logs/errors.log', Logger::ERROR));

DB::$user = 'cp4724_tors';
DB::$password = 'bAltllSiuAad';
DB::$encoding = 'utf8';
DB::$error_handler = 'sql_error_handler';
DB::$nonsql_error_handler = 'nonsql_error_handler';
DB::$dbName = 'cp4724_tors';

// FIXME: add monolog

function nonsql_error_handler($params) {
    global $app, $log;
    $log->error("Database error: " . $params['error']);
    http_response_code(500);
    header('content-type: application/json');
    echo json_encode("Internal server error");
    die;
}

function sql_error_handler($params) {
    global $app, $log;
    $log->error("SQL error: " . $params['error']);
    $log->error(" in query: " . $params['query']);
    http_response_code(500);
    header('content-type: application/json');
    echo json_encode("Internal server error");
    die; // don't want to keep going if a query broke
}

$app = new \Slim\Slim();

\Slim\Route::setDefaultConditions(array(
    'ID' => '\d+'
));

$app->response->headers->set('content-type', 'application/json');

//************************************************************** verification

function isTodoItemValid($todo, &$error) {  
    /*if (!isset($todo['title']) || !isset($todo['dueDate']) || !isset($todo['isDone'])) {
        $error = 'The passed fields do not correspond to the expected list';
        return FALSE;
    }
    if (strlen($todo['title']) < 1 || strlen($todo['title']) > 100) {
        $error = 'Title is not valid';
        return FALSE;
    }
    if (!in_array($todo['isDone'], array('true', 'false'))) {
        $error = 'isDone is not true nor false';
        return FALSE;
    }*/
    return TRUE;
}


//************************************************************* get seats

$app->get('/seats/:ID', function($ID) use ($app) {
//    sleep(1);
    $record = DB::query("SELECT BookedSeats,NumberOfSeats FROM booking,buses,trips WHERE trips.BusID=buses.ID AND booking.TripID=trips.ID AND booking.TripID=%d", $ID);
    // 404 if record not found
    if (!$record) {
        $app->response->setStatus(404);
        echo json_encode("Record not found");
        return;
    }
    echo json_encode($record, JSON_PRETTY_PRINT);
});

$app->post('/selectedseats', function() use ($app, $log) {
    // $app->render('booking_form.html.twig');
    $body = $app->request->getBody();
    $record = json_decode($body, TRUE);
    if (!isTodoItemValid($record, $error)) {
        $app->response->setStatus(400);
        $log->debug("POST /selected seats verification failed: " . $error);
        echo json_encode($error);
        return;
    }
   $selectedTrip = array();
   $userInfo = DB::query("SELECT userName,email FROM users WHERE ID=%d", $record['user']);   
    if (!$userInfo) {
        $app->response->setStatus(404);
        echo json_encode("Record not found");
        return;
    }
    //$tripInfo = DB::query("SELECT * FROM trips WHERE ID=%d", $record['trip']);   
    $tripInfo = DB::query("SELECT trips.ID as ID,NumberOfSeats, BusID, DepartID, ArriveID, DateTimeDepart, DateTimeArrive, Price, Description,MakeModel, WiFi, AirConditioning, Toilet, PowerOutlets "
                . "FROM trips,buses WHERE trips.BusID=buses.ID AND trips.ID=%d", $record['trip']);
    if (!$tripInfo) {
        $app->response->setStatus(404);
        echo json_encode("Record not found");
        return;
    }
    $busInfo = DB::query("SELECT BusID, MakeModel, WiFi, AirConditioning, Toilet, PowerOutlets "
                . "FROM trips,buses WHERE trips.BusID=buses.ID AND trips.ID=%d", $record['trip']);
    if (!$busInfo) {
        $app->response->setStatus(404);
        echo json_encode("Record not found");
        return;
    }
    $departInfo = DB::query("SELECT citys.name, citys.Country FROM trips,citys WHERE trips.DepartID=citys.ID AND trips.ID=%d", $record['trip']);
    if (!$tripInfo) {
        $app->response->setStatus(404);
        echo json_encode("Record not found");
        return;
    }
    $arriveInfo = DB::query("SELECT citys.name, citys.Country FROM trips,citys WHERE trips.ArriveID=citys.ID AND trips.ID=%d", $record['trip']);
    if (!$tripInfo) {
        $app->response->setStatus(404);
        echo json_encode("Record not found");
        return;
    }
    $price = DB::queryOneField('Price',"SELECT * FROM trips WHERE ID=%d", $record['trip']);
    if (!$tripInfo) {
        $app->response->setStatus(404);
        echo json_encode("Record not found");
        return;
    }
    $arr=explode(",",$record['seats']);
    $countSeats=count($arr);    
    $paymentSum = sprintf("%1\$.2f", $countSeats*$price);
    
    $selectedTrip=array_merge($userInfo,$tripInfo,$busInfo,$departInfo,$arriveInfo,$record);
    //$selectedTrip{};
    $_SESSION['booking']=$selectedTrip;
    $_SESSION['countSeats']=$countSeats;
    $_SESSION['paymentSum']=$paymentSum;
    $_SESSION['price']=$price;
});

$app->post('/payment', function() use ($app, $log) {
//header( 'Location: www.sandbox.paypal.com/webscr?cmd=_express-checkout&token=' . urlencode($token) );    
$requestParams = array(
   'IPADDRESS' => $_SERVER['REMOTE_ADDR'],
   'PAYMENTACTION' => 'Sale'
);

$creditCardDetails = array(
   'CREDITCARDTYPE' => 'Visa',
   'ACCT' => '4929802607281663',
   'EXPDATE' => '062012',
   'CVV2' => '984'
);

$payerDetails = array(
   'FIRSTNAME' => 'John',
   'LASTNAME' => 'Doe',
   'COUNTRYCODE' => 'US',
   'STATE' => 'NY',
   'CITY' => 'New York',
   'STREET' => '14 Argyle Rd.',
   'ZIP' => '10010'
);

$orderParams = array(
   'AMT' => '500',
   'ITEMAMT' => '496',
   'SHIPPINGAMT' => '4',
   'CURRENCYCODE' => 'GBP'
);

$item = array(
   'L_NAME0' => 'iPhone',
   'L_DESC0' => 'White iPhone, 16GB',
   'L_AMT0' => '496',
   'L_QTY0' => '1'
);

$paypal = new Paypal();
$response = $paypal -> request('DoDirectPayment',
   $requestParams + $creditCardDetails + $payerDetails + $orderParams + $item
);

if( is_array($response) && $response['ACK'] == 'Success') { 
   $transactionId = $response['TRANSACTIONID'];
}    
});

$app->run();
