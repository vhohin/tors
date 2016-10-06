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

//************FACEBOOK********//
$fb = new Facebook\Facebook([
  'app_id' => '312636035778552',
  'app_secret' => '9c0f1b20e345ae77cfd4d434a59e3049',
  'default_graph_version' => 'v2.8',
]);

//************ END FACEBOOK *********//


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
        $app->render('selected_destination.html.twig', array('valueList'=>$result,'currentUser'=>$_SESSION['user']));
    }        
});


//**************************************************** REGISTER


$app->get('/emailexists/:email', function($email) use ($app, $log) {
    $user = DB::queryFirstRow('SELECT ID FROM users WHERE email=%s', $email);
    if ($user){
        echo "Email already registred";
    }
});

// State 1: first show
$app->get('/register', function() use ($app, $log) {
    $app->render('register.html.twig');
});
// State 2: submission
$app->post('/register', function() use ($app, $log) {
    $name = $app->request->post('name');
    $email = $app->request->post('email');
    $pass1 = $app->request->post('pass1');
    $pass2 = $app->request->post('pass2');
    $valueList = array ('name' => $name, 'email' => $email);
    // submission received - verify
    $errorList = array();
    if (strlen($name) < 4) {
        array_push($errorList, "Name must be at least 4 characters long");
        unset($valueList['name']);
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
        array_push($errorList, "Email does not look like a valid email");
        unset($valueList['email']);
    } else {
        $user = DB::queryFirstRow("SELECT ID FROM users WHERE email=%s", $email);        
        if ($user) {
            array_push($errorList, "Email already registered");
            unset($valueList['email']);
        }
    }
    if (!preg_match('/[0-9;\'".,<>`~|!@#$%^&*()_+=-]/', $pass1) || (!preg_match('/[a-z]/', $pass1)) || (!preg_match('/[A-Z]/', $pass1)) || (strlen($pass1) < 8)) {
        array_push($errorList, "Password must be at least 8 characters " .
                "long, contain at least one upper case, one lower case, " .
                " one digit or special character");
    } else if ($pass1 != $pass2) {
        array_push($errorList, "Passwords don't match");
    }
    //
    if ($errorList) {
        // STATE 3: submission failed        
        $app->render('register.html.twig', array(
            'errorList' => $errorList, 'v' => $valueList
        ));
    } else {
        // STATE 2: submission successful
        DB::insert('users', array(
            'name' => $name, 
            'email' => $email,
            'password' => password_hash ($pass1, CRYPT_BLOWFISH)
            //'password' => hash ('sha256', $pass1)
        ));
        $id = DB::insertId();
        $log->debug(sprintf("User %s created", $id));
        $app->render('register_success.html.twig');
    }
});

//**************************************************** LOGIN/LOGOUT


// State 1: first show
$app->get('/login', function() use ($app, $log) {
    $app->render('login.html.twig');
});
// State 2: submission
$app->post('/login', function() use ($app, $log) {
    $email = $app->request->post('email');
    $pass = $app->request->post('pass');
    $user = DB::queryFirstRow("SELECT * FROM users WHERE email=%s", $email);    
    if (!$user) {
        $log->debug(sprintf("User failed for email %s from IP %s",
                    $email, $_SERVER['REMOTE_ADDR']));
        $app->render('login.html.twig', array('loginFailed' => TRUE));
    } else {
        // password MUST be compared in PHP because SQL is case-insenstive
        if ($user['password'] ==  $pass) {
         //echo "psw ".$pass." pass ".$user['password'];
        //if (password_verify($pass, $user['password'])) {
            // LOGIN successful
            unset($user['password']);
            $_SESSION['user'] = $user;
            $log->debug(sprintf("User %s logged in successfuly from IP %s",
                    $user['ID'], $_SERVER['REMOTE_ADDR']));
            $app->render('login_success.html.twig');
        } else {
            $log->debug(sprintf("User failed again for email %s from IP %s",
                    $email, $_SERVER['REMOTE_ADDR']));
            $app->render('login.html.twig', array('loginFailed' => TRUE));            
        }
    }
});

$app->get('/logout', function() use ($app, $log) {
    $_SESSION['user'] = array();
    $app->render('logout_success.html.twig');
});


$app->run();