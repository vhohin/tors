<?php

require_once 'vendor/autoload.php';
session_start();

$_SESSION['facebook_access_token'] = NULL;
header("Location: /");
