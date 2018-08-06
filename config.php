<?php
require 'environment.php';
date_default_timezone_set('America/Sao_Paulo');
$config = array();
if (ENVIRONMENT == 'production') {
    define("BASE_URL", "");
    $config['dbname'] = '';
    $config['host'] = '';
    $config['dbuser'] = '';
    $config['dbpass'] = '';
} else {
    //define("BASE_URL", "");
    define("BASE_URL", "");
    $config['dbname'] = '';
    $config['host'] = '';
    $config['dbuser'] = '';
	$config['dbpass'] = '';
}

global $db;
try {
    $conf = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    $db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass'], $conf);
} catch (PDOException $e) {
    echo "ERRO: ".$e->getMessage();
    exit;
}