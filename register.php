<?php

$app->get('/emailexists/:email', function($email) use ($app, $log) {
    $user = DB::queryFirstRow('SELECT * FROM users WHERE email=%s', $email);
    if ($user) {
        echo "Email already registered";
    }
});

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
    if (!preg_match('/[0-9;\'".,<>`~|!@#$%^&*()_+=-]/', $pass1) || (!preg_match('/[a-z]/', $pass1)) || (!preg_match('/[A-Z]/', $pass1)) || (strlen($pass1) < 8)) {
        array_push($errorList, "Password must be at least 8 characters " .
                "long, contain at least one upper case, one lower case, " .
                " one digit or special character");
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
        $app->render('register_success.html.twig', array('registerSuccess'=> TRUE));
    }
});

