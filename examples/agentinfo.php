<?php
require_once('../vendor/autoload.php');

$credentials = [
    'login' => "USERNAME",
    'password' => "PASSWORD",
];

$connect = new \Bradstw\Five9\Five9Client($credentials);

print_r($connect) . "\n";
