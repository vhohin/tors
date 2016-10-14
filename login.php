<?php
//**************************************************** LOGIN/LOGOUT
//session_start();
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
