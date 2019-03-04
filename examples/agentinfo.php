<?php
require_once('../vendor/autoload.php');

$credentials = [
    'login' => "am2_agentmanager",
    'password' => "nXlcmwS5",
];

$connect = new \Bradstw\Five9\Five9Client($credentials);

print_r($connect) . "\n";
