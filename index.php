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
//**************************************************** HOME
if (!isset($_SESSION['user'])) {           
    $_SESSION['user']=array();;              
}

$app->get('/', function() use ($app,$log) {    
    /*if (isset($_SESSION['user'])) {           
            $currentUser=$_SESSION['user'];              
        } else {    
            $currentUser="";           
        }*/
        $app->render('index.html.twig',array('currentUser'=>$_SESSION['user']));
});


$app->run();