
<?php
require '../vendor/autoload.php';
require_once('../src/Blockchain.php');

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
<head>
  <title>Bitcoin Submission.</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
 
<!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/freelancer.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom buttons -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#page-top">Designated.</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="index.html">Home</a>
                    </li>
                    <li class="page-scroll">
                        <a href="addFriend.php">Add Friend</a>
                    </li>
                    <li class="page-scroll">
                        <a href="history.html">History</a>
                    </li>
                    <li class="page-scroll">
                        <a href="bitcoinform.html">Pay</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
  <div id="move-down" style="margin-top: 120px;">
        <h2 class="pay_titles">Direct your friends to <a href = "<?php echo $bitcoinpayaddress; ?>" target="_blank"> this link </a> to get paid!</h2>
        <h3 class="pay_titles"> Or have them send you money from the QR code here: </h3>
        <img class="center-block" src="<?php echo $bitcoinpayaddress; ?>" >
    </div>


</body>
<style>
    body {
        background-color: #50B7A5;
        color: white;
    }
    .pay_titles {
        padding: 15px;
        text-align: center;
    }
</style>