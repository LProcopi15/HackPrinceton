<?php
require 'vendor/autoload.php';
require_once('src/Blockchain.php');

$Blockchain = new \Blockchain\Blockchain();
$identifier = $_POST['identifier'];
$password = stripslashes($_POST['password']);

//var_dump($identifier);
//print_r($password) . "<br />" . PHP_EOL;

if(is_null($identifier) || is_null($password)) {
    echo "Please enter a wallet GUID and password.<br/>";
    exit;
}

//https://blockchain.info/qr?data=1JcnG7mrpj3gcE7njLmqxeGyQJMquCkHpR&amount=500&size=250
//Method for creating QR code from bitcoin address

$guid="a5ae20b6-39c2-49a5-91bf-de21e99fa5f2"; //My identifier
$main_password="Gorpbopbop";
$myaddress = "1JcnG7mrpj3gcE7njLmqxeGyQJMquCkHpR";

//Get user wallet addresses, pick first one and give users that address
$Blockchain->Wallet->credentials($identifier, $password);
//echo "Using wallet " . $Blockchain->Wallet->getIdentifier() . "<br />" . PHP_EOL;
$DDaddresses = $Blockchain->Wallet->getAddresses();
//print_r($DDaddresses[0]);

//My Address 1JcnG7mrpj3gcE7njLmqxeGyQJMquCkHpR

$newAddress = json_decode(file_get_contents("https://blockchain.info/merchant/$identifier/new_address?password=$password"), true);
$parseAddress = $newAddress['address'];

//echo "New Address: " . $parseAddress;

$bitcoinpayaddress = "https://blockchain.info/qr?data=$parseAddress&size=250";

$json_url = "https://blockchain.info/merchant/$identifier/balance?password=$password";

$json_data = file_get_contents($json_url);

$json_feed = json_decode($json_data);

$balance = $json_feed->balance;

//echo "Your balance is " . $balance;

?>

<html>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript" src="https://blockchain.info/Resources/wallet/pay-now-button.js"></script>
<body>

<p> Direct your friends to this link to get paid!: <a href = "<?php echo $bitcoinpayaddress; ?>" target="_blank"> Blockchain Link </a> </p>  Or have them send you money from the QR code here: <br>  <b> <img src="<?php echo $bitcoinpayaddress; ?>" > </b> 


<!--

This code is just for a bitcoin donate button

<div style="font-size:16px;margin:0 auto;width:300px" class="blockchain-btn"
     data-address="<?php echo $parseAddress; ?>" 	
     data-shared="false">
    <div class="blockchain stage-begin">
        <img src="https://blockchain.info/Resources/buttons/donate_64.png"/>
    </div>
    <div class="blockchain stage-loading" style="text-align:center">
        <img src="https://blockchain.info/Resources/loading-large.gif"/>
    </div>
    <div class="blockchain stage-ready">
         <p align="center">Please Donate To Bitcoin Address: <b>[[address]]</b></p>
         <p align="center" class="qr-code"></p>
    </div>
    <div class="blockchain stage-paid">
         Donation of <b>[[value]] BTC</b> Received. Thank You.
    </div>
    <div class="blockchain stage-error">
        <font color="red">[[error]]</font>
    </div>
</div>
-->


</body>
</html>