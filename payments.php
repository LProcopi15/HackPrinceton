<?php

require 'vendor/autoload.php';

require_once('src/Blockchain.php');


//https://blockchain.info/qr?data=1QHGj8ooHoLxoGCJc2GBsxRBJd4pwNnTGx&size=250
//Method for creating QR code from bitcoin address

$guid="4ab6d116-4fd7-4c76-9e2f-942c23ba2b11"; //My identifier
$main_password="Gorp$!9bop";
$myaddress = "1QHGj8ooHoLxoGCJc2GBsxRBJd4pwNnTGx";
//My Address 1QHGj8ooHoLxoGCJc2GBsxRBJd4pwNnTGx

$newAddress = json_decode(file_get_contents("https://blockchain.info/merchant/$guid/new_address?password=$main_password"), true);
//$parseAddress = $newAddress[address];

//echo $parseAddress;

$json_url = "https://blockchain.info/merchant/$guid/balance?password=$main_password";

$json_data = file_get_contents($json_url);

$json_feed = json_decode($json_data);

$balance = $json_feed->balance;

echo "Your balance is " . $balance;

$api_code = null;
if(file_exists('code.txt')) {
    $api_code = trim(file_get_contents('code.txt'));
}

$Blockchain = new \Blockchain\Blockchain();

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "/merchant/$guid/payment?password=$main_password&address=$myaddress&amount=20000&from=$myaddress&fee=1000&note=bop");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

$response = curl_exec($ch);
curl_close($ch);
echo "   ";
var_dump($response);

?>