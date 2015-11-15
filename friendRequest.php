<?php
session_start();

$friend = $_POST['friendUsername'];

//CURRENTPROFILE IS THE SESSION VARIABLE!!!
$currentProfile = $_SESSION["Username"];

//$db = mysqli_connect('localhost', 'root', 'password', 'test');
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "test");

//Create new database named test
$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$testdatabase = mysql_select_db("test");

if($db->connect_error){
    print "Error - Could not connnect to MySQL";
    exit;
}

echo $currentProfile;
$friendsInfo = mysqli_query($db,"SELECT * FROM Users WHERE Username = '$friend'");    
$matchID = mysqli_query($db,"SELECT * FROM Users WHERE Username = '$currentProfile'");    
$getID = mysqli_fetch_array($matchID);
$IDone = $getID['ID'];
echo $IDone;
echo '<br>';

if(!$friendsInfo) {
    die("you suck: " . mysql_error());
}

 if($row = mysqli_fetch_array($friendsInfo)){
    $uniqueID = $row['ID'];
    echo $uniqueID;
    echo '<br>';
    $userEmail = $row['Email'];
  
	$query = "insert into Relationship values ($IDone, $uniqueID, 1)"; 
	$db->query($query) or die ("Invalid insert " . $db->error); 
    header("Location: views/addFriend.php");
 }
 ?>
