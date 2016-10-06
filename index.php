<?php
session_start();
// enable on-demand class loader
require_once 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('main');
$log->pushHandler(new StreamHandler('logs/everything.log', Logger::DEBUG));
$log->pushHandler(new StreamHandler('logs/errors.log', Logger::ERROR));

//
//bAltllSiuAad   cp4724_tors
DB::$dbName = 'cp4724_tors';
DB::$user = 'cp4724_tors';
DB::$password = 'bAltllSiuAad';
//DB::$host = '169.44.80.220';
// DB::$host = '127.0.0.1'; // sometimes needed on Mac OSX
DB::$error_handler = 'sql_error_handler';
DB::$nonsql_error_handler = 'nonsql_error_handler';

function nonsql_error_handler($params) {
    global $app,$log;
    $log->error("Database error ".$params['error']);
    http_response_code(500);
    $app->render('error_internal.html.twig');
  die;
}

function sql_error_handler($params) {
    global $app,$log;
    $log->error("SQL error ".$params['error']);
    $app->error(' in query'.$params['query']);
    http_response_code(500);
    $app->render('error_internal.html.twig');
    die; // don't want to keep going if a query broke
}

// instantiate Slim - router in front controller (this file)
// Slim creation and setup
$app = new \Slim\Slim(array(
    'view' => new \Slim\Views\Twig()
        ));

$view = $app->view();
$view->parserOptions = array(
    'debug' => true,
    'cache' => dirname(__FILE__) . '/cache'
);
$view->setTemplatesDirectory(dirname(__FILE__) . '/templates');
/*
\Slim\Route::setDefaultConditions(array(
    'id' => '\d+'
));
*/

if (!isset($_SESSION['user'])) {           
    $_SESSION['user']=array();              
}
//**************************************************** HOME select trip
$app->get('/', function() use ($app,$log) {
    $app->render('index.html.twig',array('currentUser'=>$_SESSION['user']));
});
//**************************************************** Selected trip
$app->post('/select', function() use ($app,$log) {
// State 0: Get datas from form    
    $depart = $app->request->post('depart');
    $arrive = $app->request->post('arrive');
    $dateTimeDepart = $app->request->post('dateTimeDepart');
    $dateTimeArrive = $app->request->post('dateTimeArrive');
    $typeTrip = $app->request->post('typeTrip');
 // State 1: Verification
    $errorList = array();
    if (strlen($depart)<1 || strlen($depart)>50 || strlen($arrive)<1 || strlen($arrive)>50) {
        array_push($errorList, "Depart and Arrive must have from 1 to 50 characters");
    } elseif ($depart==$arrive) {
        array_push($errorList, "Depart and Arrive must de different places");
    }
    
    $tempDateD = explode('-', $dateTimeDepart);
    $tempDateA = explode('-', $dateTimeArrive);
    if (empty($dateTimeDepart) && empty($dateTimeArrive)) {
        array_push($errorList, "Select Depart or Arrive Date");
    } elseif (!empty($dateTimeDepart)){        
        if (count($tempDateD) != 3) {
            array_push($errorList, "Not enough datas in Depart Date");
        } elseif (!checkdate($tempDateD[1], $tempDateD[2], $tempDateD[0])) {
            array_push($errorList, "Bad format Depart Date");
        }/* elseif (date("Y-m-d") > date($tempDateD,"Y-m-d")) {
            array_push($errorList, "Depart Date must be later then Now");
        }  */ 
    } elseif (!empty($dateTimeArrive)){        
        if (count($tempDateA) != 3) {
            array_push($errorList, "Not enough datas in Arrive Date");
        } elseif (!checkdate($tempDateA[1], $tempDateA[2], $tempDateA[0])) {
            array_push($errorList, "Bad format Arrive Date");
        }/*elseif (date("Y-m-d") > date($tempDateA,"Y-m-d")) {
            array_push($errorList, "Arrive Date must be later then Now");
        }  */        
    } elseif (!empty($dateTimeDepart) && !empty($dateTimeArrive) && ($tempDateD > $tempDateA)){
            array_push($errorList, "Depart Date later then Arrive Date");
    }      
// State 2: Submission    
    //$result = DB::query("SELECT * FROM trips WHERE Depart=%s and Arrive=%s and DateTimeDepart<%s and DateTimeArrive<%s", $depart,$arrive,$dateTimeDepart,$dateTimeArrive); 
    $result = DB::query("SELECT * FROM trips WHERE Depart=%s and Arrive=%s", $depart,$arrive); 
    //$result = DB::query("SELECT * FROM trips"); 
    if (!$result){
            array_push($errorList, "Not this dastination"); //password_hash ( string $password , integer $algo [, array $options ] )
        }
    if ($errorList) {
// State 3: failed submission
        $app->render('index.html.twig', array('errorList' => $errorList,'dateTimeDepart'=>$dateTimeDepart,'dateTimeArrive'=>$dateTimeArrive));
        //$log->debug("");
    } else {
        $app->render('selected_destination.html.twig', array('valueList'=>$result,'currentUser'=>$_SESSION['user'],'dateTimeDepart'=>$dateTimeDepart,'dateTimeArrive'=>$dateTimeArrive));
    }        
});




$app->run();