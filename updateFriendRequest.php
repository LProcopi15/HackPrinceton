<?php
session_start();

//$db = mysqli_connect('localhost', 'root', 'password', 'test');
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "test");

$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$testdatabase = mysql_select_db("test");

if($db->connect_error){
    print "Error - Could not connnect to MySQL";
    exit;
}

$sessionID = $_SESSION["ID"];

$type = $_POST["type"];
$id = $_POST["id"];



if($type == 2){
    $query = "update Relationship set Status = 2 where Friend1 = '$id' AND Friend2 = '$sessionID'";
    $result = $db->query($query) || die("BOGUS A $type");
    echo "accepted";
}

if($type == 3){
    $query = "update Relationship set Status = 3 where Friend1 = '$id' AND Friend2 = '$sessionID'";
    $result = $db->query($query) || die("BOGUS A $type");
    echo "denied";
    
}

?>