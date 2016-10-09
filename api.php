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
    // FIXME: verify $record contains all and only fields required with valid values
    if (!isTodoItemValid($record, $error)) {
        $app->response->setStatus(400);
        $log->debug("POST /selected seats verification failed: " . $error);
        echo json_encode($error);
        return;
    }
    //$record = DB::query("SELECT BookedSeats,NumberOfSeats FROM booking,buses,trips WHERE trips.BusID=buses.ID AND booking.TripID=trips.ID AND booking.TripID=%d", $ID);
    // 404 if record not found
    if (!$record) {
        $app->response->setStatus(404);
        echo json_encode("Record not found");
        return;
    }
    $log->debug("Body: " . $body);
    $_SESSION['booking']=$record;
    //$_SESSION['tripID']=$record['tripID'];
    //$_SESSION['seats']=$record['seats'];
    //$_SESSION['tripID']=$record['tripID'];
    //$app->render('booking_form.html.twig', array('valueList' => $body, 'currentUser' => $_SESSION['user']));*/
    //$log->debug("POST /todoitems verification failed: " . $record);
    //$seats=explode($record['seats']);
    /*foreach($seats as $seat){
        $recordtodb={"PassengerID":3,"TripID":10,"seats":"29,41,30,31"};
        DB::insert('trips', $recordtodb);
    }*/
    
    //echo DB::insertId();
    // POST / INSERT is special - returns 201    
    //print_r($record);
   
});

$app->run();
