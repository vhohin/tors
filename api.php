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

$app->get('/seats/:ID', function($ID) use ($app,$log) {   
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
    
    $selectedTrip=array_merge($tripInfo,$busInfo,$departInfo,$arriveInfo,$record);//$userInfo,
    //$selectedTrip{};
    $_SESSION['booking']=$selectedTrip;
    $_SESSION['countSeats']['seats']=$countSeats;
    $_SESSION['paymentSum']['sum']=$paymentSum;    
    $_SESSION['price']=$price;
    $app->render('booking_form.html.twig');
});

//******************************************************* PAYMENT
$app->post('/payment', function() use ($app, $log) {
    $paypal_email = 'user@domain.com';
    $return_url = 'http://tors.ipd8.info';
    $cancel_url = 'http://tors.ipd8.info/paymentcancelled';
    $notify_url = 'http://tors.ipd8.info/api.php/payment';
    
    $passengerID = $app->request()->post('PassengerID');
    $tripID = $app->request()->post('TripID');
    $unitPrice = $app->request()->post('UnitPrice');
    $seats = $app->request()->post('BookedSeats');
    //$PaymentInfo = "paypal";
    
    $item_name = $app->request()->post('item_name');
    $amount = $app->request()->post('amount');
    $cmd = $app->request()->post('cmd');
    $quantity = $app->request()->post('quantity');
    $no_note = $app->request()->post('no_note');
    $lc = $app->request()->post('lc');
    $currency_code = $app->request()->post('currency_code');
    $bn = $app->request()->post('bn');
    $first_name = $app->request()->post('first_name');
    $email = $app->request()->post('email');    
    
    if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])) {
            DB::insert('bookingtemp', array(
            'PassengerID' => $passengerID,
            'TripID' => $tripID,
            'BookedSeats' => $seats,
            'UnitPrice'  =>  $unitPrice
        ));
        $id = DB::insertId();
        //$log->debug(sprintf("Booking %s seats to trip %s information was added to DB with id=%id", $seats, $tripID, $id));
        // add to paypa; link string    
        $item_number=$id;
    
    $querystring = '';
    // Firstly Append paypal account to querystring
    $querystring .= "?business=" . urlencode($paypal_email) . "&";
    $querystring .= "item_name=".urlencode($item_name) . "&";
    $querystring .= "amount=".urlencode($amount) . "&";
    $querystring .= "cmd=".urlencode($cmd) . "&";
    $querystring .= "quantity=".urlencode($quantity) . "&";
    $querystring .= "no_note=".urlencode($no_note) . "&";
    $querystring .= "lc=".urlencode($lc) . "&";
    $querystring .= "currency_code=".urlencode($currency_code) . "&";
    $querystring .= "bn=".urlencode($bn) . "&";
    $querystring .= "first_name=".urlencode($first_name) . "&";
    $querystring .= "email=".urlencode($email) . "&";
    $querystring .= "item_number=".urlencode($item_number) . "&";
    
    // Append paypal return addresses
    $querystring .= "return=" . urlencode(stripslashes($return_url)) . "&";
    $querystring .= "cancel_return=" . urlencode(stripslashes($cancel_url)) . "&";
    $querystring .= "notify_url=" . urlencode($notify_url);
    // Append querystring with custom field
    // Redirect to paypal IPN
    header('location:https://www.sandbox.paypal.com/cgi-bin/webscr' . $querystring);
    exit();
} else {    
    $payementTotal = $app->request()->post('mc_gross');
    $payer_id = $app->request()->post('payer_id');
    $payment_date = $app->request()->post('payment_date');
    $txn_id = $app->request()->post('txn_id');
    $receiver_id = $app->request()->post('receiver_id');
    $item_number = $app->request()->post('item_number');
    $booking_info = DB::queryFirstRow("SELECT * FROM bookingtemp WHERE ID=%d", $item_number);
    if (!$booking_info) {
        $app->response->setStatus(404);
        $log->debug(sprintf("Booking ERROR: item number  id=%d not found", $item_number));
        //$app->render('payment_result.html.twig', array('currentUser' => $_SESSION['user']));
        return;
    }
    //$log->debug(sprintf("Booking INFO: item number  id=%s", $booking_info['ID']));
    //$log->debug(sprintf("Paypal INFO: payer_id=%s, payment_date=%s, txn_id=%s, receiver_id=%s, item_number =%s", $payer_id,$payment_date,$txn_id,$receiver_id,$item_number));
    
    $BookedSeats=$booking_info['BookedSeats'];
    $arr = explode(",", $BookedSeats);
    $countSeats = count($arr);

    foreach ($arr as $seat) {
        DB::insert('booking', array(
            'PassengerID' => $booking_info['PassengerID'],
            'TripID' => $booking_info['TripID'],
            'txn_id' => $txn_id,
            'payer_id' => $payer_id,
            'receiver_id' => $receiver_id,
            'PaymentDate' => $payment_date,
            'UnitPrice' => $booking_info['UnitPrice'],
            'PaymentTotal' => $payementTotal,
            'BookedSeats' => $seat,
            'Status' => 'paid'
        ));
        $id = DB::insertId();
        $log->debug(sprintf("Booking inserting INFO: item_number =%s, payer_id=%s, payment_date=%s, was successful inserted with id=%s",$item_number,$payer_id,$payment_date, $id));
    }
    //$app->render('paymentg_result.html.twig');
}
    
});
//******************************************************* PAYMENT do not use (test)
$app->post('/paymentpaypal', function() use ($app, $log) {

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

$app->post('/payment', function() use ($app, $log) {
if( isset($_GET['token']) && !empty($_GET['token']) ) { // Токен присутствует
   // Получаем детали оплаты, включая информацию о покупателе.
   // Эти данные могут пригодиться в будущем для создания, к примеру, базы постоянных покупателей
   $paypal = new Paypal();
   $checkoutDetails = $paypal -> request('GetExpressCheckoutDetails', array('TOKEN' => $_GET['token']));

   // Завершаем транзакцию
   $requestParams = array(
      'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale',
      'PAYERID' => $_GET['PayerID']
   );

   $response = $paypal -> request('DoExpressCheckoutPayment',$requestParams);
   if( is_array($response) && $response['ACK'] == 'Success') { // Оплата успешно проведена
      // Здесь мы сохраняем ID транзакции, может пригодиться во внутреннем учете
      $transactionId = $response['PAYMENTINFO_0_TRANSACTIONID'];
   }
}
    });
$app->run();
