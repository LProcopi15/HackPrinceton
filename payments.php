<?php
require_once('src/Blockchain.php');

require_once(dirname(__DIR__) . '/vendor/autoload.php');

$api_code = null;
if(file_exists('code.txt')) {
    $api_code = trim(file_get_contents('code.txt'));
}

$Blockchain = new \Blockchain\Blockchain($api_code);








?>