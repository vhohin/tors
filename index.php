<?php

session_start();
// enable on-demand class loader
require_once 'vendor/autoload.php';

//require_once 'lock.php';
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('main');
$log->pushHandler(new StreamHandler('logs/everything.log', Logger::DEBUG));
$log->pushHandler(new StreamHandler('logs/errors.log', Logger::ERROR));

//
//bAltllSiuAad   cp4724_tors
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    DB::$dbName = 'cp4724_tors';
    DB::$user = 'cp4724_tors';
    DB::$password = 'bAltllSiuAad';
    DB::$encoding = 'utf8';
} else {
    DB::$dbName = 'cp4724_tors';
    DB::$user = 'cp4724_tors';
    DB::$password = 'bAltllSiuAad';
    DB::$encoding = 'utf8';
}
//DB::$host = '169.44.80.220';
// DB::$host = '127.0.0.1'; // sometimes needed on Mac OSX
DB::$error_handler = 'sql_error_handler';
DB::$nonsql_error_handler = 'nonsql_error_handler';

function nonsql_error_handler($params) {
    global $app, $log;
    $log->error("Database error " . $params['error']);
    http_response_code(500);
    $app->render('error_internal.html.twig');
    die;
}

function sql_error_handler($params) {
    global $app, $log;
    $log->error("SQL error " . $params['error']);
    $app->error(' in query' . $params['query']);
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

\Slim\Route::setDefaultConditions(array(
    'id' => '\d+'
));


if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = array();
}

$twig = $app->view()->getEnvironment();
$twig->addGlobal('currentUser', $_SESSION['user']); // replace 'currentUser' => $_SESSION['user'],

$cityList = array();
//**************************************************** HOME select trip
$app->get('/', function() use ($app, $log) {
    GLOBAL $cityList;
    $errorList = array();
    $cityList = DB::query("SELECT * FROM citys ORDER BY name");
    if (!$cityList) {
        array_push($errorList, "Not citys in database");
    }
    if ($errorList) {
        $app->render('index.html.twig', array('errorList' => $errorList));
    } else {
        $app->render('index.html.twig', array('currentUser' => $_SESSION['user'], 'cityList' => $cityList));
    }

    if (isset($_SESSION['countSeats'])) {
        $_SESSION['countSeats'] = array();
    }
    if (isset($_SESSION['booking'])) {
        $_SESSION['booking'] = array();
    }
    if (isset($_SESSION['paymentSum'])) {
        $_SESSION['paymentSum'] = array();
    }
    if (isset($_SESSION['price'])) {
        $_SESSION['price'] = array();
    }
});
//**************************************************** Selected trip
$app->post('/select', function() use ($app, $log) {
// State 0: Get datas from form   
    GLOBAL $cityList;
    $depart = $app->request->post('departID');
    $arrive = $app->request->post('arriveID');
    $dateTimeDepart = $app->request->post('dateTimeDepart');
    $dateTimeArrive = $app->request->post('dateTimeArrive');
    $typeTrip = $app->request->post('typeTrip');
    $v = array('departID' => $depart, 'arriveID' => $arrive, 'dateTimeDepart' => $dateTimeDepart, 'dateTimeArrive' => $dateTimeArrive, 'typeTrip' => $typeTrip);
// State 1: Verification
    $errorList = array();
    if (!is_numeric($depart) || !is_numeric($depart)) {
        $log->debug("ERROR: Depart ID and Arrive ID must be numeric");
    } elseif ($depart == $arrive) {
        $log->debug("ERROR: Depart and Arrive must de different places");
    }

    $tempDateD = explode('-', $dateTimeDepart);
    $tempDateA = explode('-', $dateTimeArrive);
    if (empty($dateTimeDepart) && empty($dateTimeArrive)) {
        array_push($errorList, "ERROR: Select Depart or Arrive Date");
    } elseif (!empty($dateTimeDepart)) {
        if (count($tempDateD) != 3) {
            $log->debug("ERROR: Not enough datas in Depart Date");
        } elseif (!checkdate($tempDateD[1], $tempDateD[2], $tempDateD[0])) {
            $log->debug("ERROR: Bad format Depart Date");
        }/* elseif (date("Y-m-d") > date($tempDateD,"Y-m-d")) {
          array_push($errorList, "Depart Date must be later then Now");
          } */
    } elseif (!empty($dateTimeArrive)) {
        if (count($tempDateA) != 3) {
            $log->debug("ERROR: Not enough datas in Arrive Date");
        } elseif (!checkdate($tempDateA[1], $tempDateA[2], $tempDateA[0])) {
            $log->debug("ERROR: Bad format Arrive Date");
        }/* elseif (date("Y-m-d") > date($tempDateA,"Y-m-d")) {
          array_push($errorList, "Arrive Date must be later then Now");
          } */
    } elseif (!empty($dateTimeDepart) && !empty($dateTimeArrive) && ($tempDateD > $tempDateA)) {
        $log->debug("ERROR: Depart Date later then Arrive Date");
    }
// State 2: Submission    
//$result = DB::query("SELECT * FROM trips WHERE Depart=%s and Arrive=%s and DateTimeDepart<%s and DateTimeArrive<%s", $depart,$arrive,$dateTimeDepart,$dateTimeArrive); 
    $result = DB::query("SELECT trips.ID as ID,NumberOfSeats, BusID, DepartID, ArriveID, DateTimeDepart, DateTimeArrive, Price, Description,MakeModel, WiFi, AirConditioning, Toilet, PowerOutlets "
                    . "FROM trips,buses WHERE trips.BusID=buses.ID AND DepartID=%d AND ArriveID=%d ORDER BY DateTimeDepart", (int) $depart, (int) $arrive);
////$result = DB::query("SELECT * FROM trips WHERE Depart=%s and Arrive=%s", $depart,$arrive); 
    GLOBAL $cityList;
    if (!$result) {
        $errorList = array();
        $cityList = DB::query("SELECT * FROM citys ORDER BY name");
        if (!$cityList) {
            array_push($errorList, "Not citys in database");
        }
        $log->debug("ERROR: Not this dastination");
        array_push($errorList, "Not this dastination, change date or destination and try again");
        $app->render('index.html.twig', array('cityList' => $cityList, 'currentUser' => $_SESSION['user'], 'errorList' => $errorList, 'v' => $v));
    } else {
        $departCity = DB::queryFirstField("SELECT name FROM citys WHERE ID=%d", $depart);
        $arriveCity = DB::queryFirstField("SELECT name FROM citys WHERE ID=%d", $arrive);
        if (!$departCity || !$arriveCity) {
            $log->debug("ERROR: Not found names of city for select destination");
        }
        $app->render('selected_destination.html.twig', array('valueList' => $result, 'currentUser' => $_SESSION['user'], 'departCity' => $departCity, 'arriveCity' => $arriveCity));
    }
});
//**************************************************** Payment
$app->post('/payment', function() use ($app, $log) {
    $PassengerID = $app->request->post('PassengerID');
    $TripID = $app->request->post('TripID');
    $PaymentInfo = $app->request->post('PaymentInfo');
    $PaymentDate = $app->request->post('PaymentDate');
    $BookesSeats = $app->request->post('BookesSeats');

    $log->debug(sprintf("Booking %s seat to trip %s information", $BookesSeats, $TripID));

    $arr = explode(",", $BookesSeats);
    $countSeats = count($arr);

    foreach ($arr as $seat) {
        DB::insert('booking', array(
            'PassengerID' => $PassengerID,
            'TripID' => $TripID,
            'PaymentInfo' => $PaymentInfo,
            'PaymentDate' => $PaymentDate,
            'BookedSeats' => $seat
        ));
        $id = DB::insertId();
        $log->debug(sprintf("Booking %s seat to trip %s information was added to DB with id=%id", $BookesSeats, $TripID, $id));
    }
    $app->render('payment_success.html.twig', array('currentUser' => $_SESSION['user']));
});

$app->get('/paymentsuccess', function() use ($app, $log) {
    $app->render('payment_success.html.twig', array('currentUser' => $_SESSION['user']));
});
$app->get('/paymentcancelled', function() use ($app, $log) {
    $app->render('payment_cancel.html.twig', array('currentUser' => $_SESSION['user']));
});
//**************************************************** Booking Form
$app->get('/bookingform', function() use ($app, $log) {
    $browserName = $_SERVER['HTTP_USER_AGENT'];
    if (strpos(strtolower($browserName), "firefox/")) {
        // FIREFOX
        print '<script type="text/javascript">';
        print 'alert("The browser Firefox not supported, change browser.")';
        print '</script>';
        $app->render('index.html.twig');
    } else {
        $app->render('booking_form.html.twig', array('currentUser' => $_SESSION['user'], 'booking' => $_SESSION['booking'], 'countSeats' => $_SESSION['countSeats'], 'paymentSum' => $_SESSION['paymentSum'], 'countSeats' => $_SESSION['countSeats']));
    }
});

//**************************************************** Selected bus
$app->get('/selectbus/:BusID', function($BusID) use ($app, $log) {
    $bus = DB::queryFirstRow('SELECT * FROM buses WHERE ID=%d', $BusID);
    if (!$bus) {
        $log->debug("ERROR: Not found bus for selected destination");
    }
    $seats = DB::query('SELECT * FROM seats WHERE BusID=%d', $BusID);
    if (!$seats) {
        $log->debug("ERROR: Not found seats for selected bus");
    }
    $app->render('selected_bus.html.twig', array('bus' => $bus, 'currentUser' => $_SESSION['user']));
});
$app->get('/selectbus', function() use ($app, $log) {
    $app->render('selected_bus.html.twig', array('currentUser' => $_SESSION['user']));
});


//facebook login

$fb = new Facebook\Facebook([
    'app_id' => "312636035778552",
    'app_secret' => "9c0f1b20e345ae77cfd4d434a59e3049",
    'default_graph_version' => 'v2.5',
    'persistent_data_handler' => 'session'
        ]);

// sessions
$helper = $fb->getRedirectLoginHelper();
$permissions = ['public_profile', 'email', 'user_location']; // optional

$loginUrl = $helper->getLoginUrl('http://tors.ipd8.info/fblogin.php', $permissions);
$logoutUrl = $helper->getLogoutUrl('http://tors.ipd8.info/fblogout.php', $permissions);

$fbUser = array();
if (!isset($_SESSION['facebook_access_token'])) {
    $_SESSION['facebook_access_token'] = array();
} else {
    $fbUser = $_SESSION['facebook_access_token'];
}


$uID = 0;
if ($_SESSION['facebook_access_token']) {
    $userID = DB::queryFirstRow('SELECT * from users WHERE fbID = %s', $fbUser['ID']);
    if (!$userID) {
        $result = DB::insert('users', array(
                    'fbID' => $fbUser['ID'],
                    'userName' => $fbUser['name'],
                    'email' => $fbUser['email']
        ));
        if ($result) {
            $uID = DB::insertId();
            $_SESSION['user'] = $userID;
            $log->debug(sprintf("Registred facebook user %s with id %s", $_SESSION['facebook_access_token']['ID'], $uID));
            $_SESSION['facebook_access_token']['userID'] = array();
        } else {
            $log->debug(sprintf("Failed to register facebook user %d", $_SESSION['facebook_access_token']['ID']));
            $_SESSION['facebook_access_token'] = array();

            //$app->render('fblogin_failed.html.twig');
        }
    } else {
        $_SESSION['user'] = $userID;
    }
}



$twig = $app->view()->getEnvironment();
$twig->addGlobal('fbUser', $fbUser);
$twig->addGlobal('loginUrl', $loginUrl);
$twig->addGlobal('logoutUrl', $logoutUrl);

//print_r($fbUser);
//print_r($_SESSION['fbmetadata']);

//**************************REGISTER************************** 


$app->get('/emailexists/:email', function($email) use ($app, $log) {
    $user = DB::queryFirstRow('SELECT * FROM users WHERE email=%s', $email);
    if ($user) {
        echo "Email already registered";
    }
});

// returns TRUE if password is strong enought, otherwise returns STRING describing the problem
function verifyPassword($pass1) {
    if (!preg_match('/[0-9;\'".,<>`~|!@#$%^&*()_+=-]/', $pass1) || (!preg_match('/[a-z]/', $pass1)) || (!preg_match('/[A-Z]/', $pass1)) || (strlen($pass1) < 8)) {
        return "Password must be at least 8 characters " .
                "long, contain at least one upper case, one lower case, " .
                " one digit or special character";
    }
    return TRUE;
}

// State 1: first show
$app->get('/register', function() use ($app, $log) {

    //unset users
    $_SESSION['user'] = array();
    $_SESSION['facebook_access_token'] = array();

    $app->render('register.html.twig');
});
// State 2: submission
$app->post('/register', function() use ($app, $log) {
    $firstName = $app->request->post('firstName');
    $lastName = $app->request->post('lastName');
    $userName = $app->request->post('userName');
    $email = $app->request->post('email');
    $pass1 = $app->request->post('pass1');
    $pass2 = $app->request->post('pass2');
    $phone = $app->request->post('phone');

    $valueList = array(
        'firstName' => $firstName,
        'lastName' => $lastName,
        'userName' => $userName,
        'email' => $email,
        'phone' => $phone
    );
// submission received - verify
    $errorList = array();
    if (!empty($firstName)) {
        if (strlen($firstName) < 2 || strlen($firstName) > 50) {
            array_push($errorList, "First Name must be at least 2 and not longer than 50 characters long");
            unset($valueList['firstName']);
        }
    }
    if (!empty($lastName)) {
        if (strlen($lastName) < 2 || strlen($lastName) > 50) {
            array_push($errorList, "Last Name must be at least 2 and not longer than 50  characters long");
            unset($valueList['lastName']);
        }
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
        array_push($errorList, "Email does not look like a valid email");
        unset($valueList['email']);
    } else {
        $user = DB::queryFirstRow("SELECT * FROM users WHERE email=%s", $email);
        if ($user) {
            array_push($errorList, "Email already registered");
            unset($valueList['email']);
        }
    }
    
    // verify password
    $msg = verifyPassword($pass1);

    if ($msg !== TRUE) {
        array_push($errorList, $msg);
    } else if ($pass1 != $pass2) {
        array_push($errorList, "Passwords don't match");
    }
    if (!empty($phone)) {
        if (!preg_match("/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/", $phone)) {
            array_push($errorList, "Canadian phone number is invalid");
            unset($valueList['phone']);
        }
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
            'firstName' => $firstName,
            'lastName' => $lastName,
            'userName' => $userName,
            'email' => $email,
            'phone' => $phone,
            'password' => password_hash($pass1, CRYPT_BLOWFISH)
                //'password' => hash ('sha256', $pass1)
        ));
        $id = DB::insertId();
        $log->debug(sprintf("User %s created", $id));
        $app->render('register_success.html.twig', array('registerSuccess' => TRUE));
    }
});

//************************ LOGIN/LOGOUT****************************


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
        $log->debug(sprintf("User failed for email %s from IP %s", $email, $_SERVER['REMOTE_ADDR']));
        $app->render('login.html.twig', array('loginFailed' => TRUE));
    } else {
        // password MUST be compared in PHP because SQL is case-insenstive
        //if ($user['password'] ==  $pass) {
        //echo "psw ".$pass." pass ".$user['password'];
        if (password_verify($pass, $user['password'])) {
            // LOGIN successful
            unset($user['password']);
            $_SESSION['user'] = $user;
            $_SESSION['facebook_access_token'] = array();
            $log->debug(sprintf("User %s logged in successfuly from IP %s", $user['ID'], $_SERVER['REMOTE_ADDR']));
            if (isset($_SESSION['booking']) && !empty($_SESSION['booking'])){
                $app->render('login_success.html.twig',array('booking' => "TRUE"));
            } else {
                $app->render('login_success.html.twig');
            }            
        } else {
            $log->debug(sprintf("User failed again for email %s from IP %s", $email, $_SERVER['REMOTE_ADDR']));
            $app->render('login.html.twig', array('loginFailed' => TRUE));
        }
    }
});

$app->get('/logout', function() use ($app, $log) {
    $_SESSION['user'] = array();
    $_SESSION['facebook_access_token'] = array();
    $app->render('logout_success.html.twig');
});

// PASSWORD RESET via map

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$app->map('/passreset', function () use ($app, $log) {

    if ($app->request()->isGet()) { // GET method via map
        $app->render('passreset.html.twig');
    } else { // else POST method via map
        $email = $app->request()->post('email');
        $user = DB::queryFirstRow("SELECT * FROM users WHERE email=%s", $email);
        if ($user) {
            $app->render('passreset_success.html.twig');
            $secretToken = generateRandomString(50);
            // VERSION 1: delete and insert

            /* DB::delete('passreset', 'userID=%d', $user['ID']);
              DB::insert('passreset', array(
              'userID' => $user['ID'],
              'secretToken' => $secretToken,
              'expirydateTime' => date("Y-m-d H:i:s", strtotime("+5 hours"))
              )); */

            // VERSION 2: insert-update "passresets" table
            DB::insertUpdate('passresets', array(
                'userID' => $user['ID'],
                'secretToken' => $secretToken,
                'expiryDateTime' => date("Y-m-d H:i:s", strtotime("+5 hours"))
            ));
            // email user
            $url = 'http://' . $_SERVER['SERVER_NAME'] . '/passreset/' . $secretToken;
            $html = $app->view()->render('email_passreset.html.twig', array(
                'email' => $user['email'],
                'url' => $url
            ));
            $headers = "MIME-Version: 1.0\r\n";
            $headers.= "Content-Type: text/html; charset=UTF-8\r\n";
            $headers.= "From: Noreply <noreply@ipd8.info>\r\n";
            $headers.= "To :" . htmlentities($user['email'] . "\r\n");
            mail($email, "Password reset from TORS", $html, $headers);
        } else {
            $app->render('passreset.html.twig', array('error' => TRUE));
        }
    }
})->via("GET", "POST");


$app->map('/passreset/:secretToken', function($secretToken) use ($app) {
    $row = DB::queryFirstRow("SELECT * FROM passresets WHERE secretToken=%s", $secretToken);
    if (!$row) {
        $app->render('passreset_notfound_expired.html.twig');
        return;
    }
    if (strtotime($row['expiryDateTime']) < time()) {
        $app->render('passreset_notfound_expired.html.twig');
        return;
    }
    // 
    if ($app->request()->isGet()) {
        $app->render('passreset_form.html.twig');
    } else {
        $pass1 = $app->request()->post('pass1');
        $pass2 = $app->request()->post('pass2');

        //TODO: veryfy password quality and that pass1 matchs pass2
        $errorList = array();
        $msg = verifyPassword($pass1);
        if ($msg !== TRUE) {
            array_push($errorList, $msg);
        } else if ($pass1 != $pass2) {
            array_push($errorList, "Passwords don't match");
        }
        //
        if ($errorList) {
            $app->render('passreset_form.html.twig', array(
                'errorList' => $errorList
            ));
        } else {
            // success - reset the password
            DB::update('users', array(
                'password' => password_hash($pass1, CRYPT_BLOWFISH)
                    ), "ID=%d", $row['userID']);
            DB::delete('passresets', 'secretToken=%s', $secretToken);
            $app->render('passreset_form_success.html.twig');
        }
    }
})->via('GET', 'POST');


// *************************** EDIT PROFILE *********************
$app->get('/profile/:ID', function($ID) use ($app, $log) {
    $userInfo = DB::query("SELECT * FROM users");

    if (!$userInfo) {
        $log->debug("ERROR: No info about user" . $userInfo);
    }
    $app->render('profile.html.twig', array('userInfo' => $userInfo, 'currentUser' => $_SESSION['user']));
});

$app->post('/profile/:ID', function($ID) use ($app, $log) {
    $firstName = $app->request->post('firstName');
    $lastName = $app->request->post('lastName');
    $userName = $app->request->post('userName');
    $email = $app->request->post('email');
    $pass1 = $app->request->post('pass1');
    $pass2 = $app->request->post('pass2');
    $phone = $app->request->post('phone');

    // UPDATE DB::update
    $valueList = array('firstName' => $firstName, 'lastName' => $lastName, 'userName' => $userName, 'email' => $email, 'phone' => $phone);
// submission received - verify
    $errorList = array();
    if (!empty($firstName)) {
        if (strlen($firstName) < 2) {
            array_push($errorList, "First Name must be at least 2 characters long");
            unset($valueList['firstName']);
        }
    }
    if (!empty($lastName)) {
        if (strlen($lastName) < 2) {
            array_push($errorList, "Last Name must be at least 2 characters long");
            unset($valueList['lastName']);
        }
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
        array_push($errorList, "Email does not look like a valid email");
        //unset($valueList['email']);
    }
    /* else {
      $user = DB::queryFirstRow("SELECT * FROM users WHERE email=%s", $email);
      if ($user) {
      array_push($errorList, "Email already registered");
      //unset($valueList['email']);
      }

      } */
    if (!preg_match('/[0-9;\'".,<>`~|!@#$%^&*()_+=-]/', $pass1) || (!preg_match('/[a-z]/', $pass1)) || (!preg_match('/[A-Z]/', $pass1)) || (strlen($pass1) < 8)) {
        array_push($errorList, "Password must be at least 8 characters " .
                "long, contain at least one upper case, one lower case, " .
                " one digit or special character");
    } else if ($pass1 != $pass2) {
        array_push($errorList, "Passwords don't match");
    }
    if (!empty($phone)) {
        if (!preg_match("/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/", $phone)) {
            array_push($errorList, "Phone number is invalid");
            unset($valueList['phone']);
        }
    }
//
    if ($errorList) {
        // STATE 3: submission failed        
        $app->render('profile.html.twig', array(
            'errorList' => $errorList, 'currentUser' => $valueList
        ));
    } else {
        DB::update('users', array(
            'firstName' => $firstName,
            'lastName' => $lastName,
            'userName' => $userName,
            'email' => $email,
            'phone' => $phone,
            'password' => password_hash($pass1, CRYPT_BLOWFISH)
                ), 'ID=%s', $ID);
/////////////////////////////////////////////////////////////////////////////////////////////
        if (isset($_SESSION['user'])) {
            $_SESSION['user'] = array();
        }

        /* $pass = password_hash($pass1, CRYPT_BLOWFISH);
          $user = DB::queryFirstRow("SELECT * FROM users WHERE email=%s", $email);
          if (!$user) {
          $log->debug(sprintf("User failed for email %s from IP %s", $email, $_SERVER['REMOTE_ADDR']));
          $app->render('login.html.twig', array('loginFailed' => TRUE));
          } else {
          // password MUST be compared in PHP because SQL is case-insenstive
          //if ($user['password'] ==  $pass) {
          //echo "psw ".$pass." pass ".$user['password'];
          if (password_verify($pass, $user['password'])) {
          // LOGIN successful
          unset($user['password']);
          $_SESSION['user'] = $user;
          $_SESSION['facebook_access_token'] = array();
          $log->debug(sprintf("User %s logged in successfuly from IP %s", $user['ID'], $_SERVER['REMOTE_ADDR']));
          $app->render('login_success.html.twig');
          } else {
          $log->debug(sprintf("User failed again for email %s from IP %s", $email, $_SERVER['REMOTE_ADDR']));
          $app->render('login.html.twig', array('loginFailed' => TRUE));
          }
          } */


        $log->debug("User profile updated with ID =" . $ID);
        $app->render('update_success.html.twig');
    }
});


$app->run();
