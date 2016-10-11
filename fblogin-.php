<?php

//FACEBOOK login
$fbID = "312636035778552";
$fbPass = "9c0f1b20e345ae77cfd4d434a59e3049";
$fb = new Facebook\Facebook([
    'app_id' => $fbID,
    'app_secret' => $fbPass,
    'default_graph_version' => 'v2.5',
    'persistent_data_handler' => 'session'
        ]);



$helper = $fb->getRedirectLoginHelper();
$permissions = ['public_profile', 'email', 'user_location']; // optional

$loginUrl = $helper->getLoginUrl('http://tors.ipd8.info/fblogin-callback.php', $permissions);

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';

