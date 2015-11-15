<?php
session_start();
$sessionName = $_SESSION["Username"];
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

$nameArray = $_POST["names"];
$dbReady = $_POST["rest"];

$rest = (explode(',',$dbReady));
$date= $rest[0];
$dest = $rest[1];



$query = "insert into Event values ('$sessionName', '$date', '$dest', '$nameArray')"; 
$db->query($query) or die ("Invalid insert " . $db->error); 




?>