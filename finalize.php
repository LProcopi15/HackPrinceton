<?php
session_start();
$sessionName = $_SESSION["Username"];
$db = mysqli_connect('localhost', 'root', 'password', 'test');
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