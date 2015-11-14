<?php

session_start();
$sessionUsername = $_POST['username'];
$sessionPassword = $_POST['password'];
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
$result = mysqli_query($db,"SELECT * FROM Users WHERE Username = '$sessionUsername' AND password = '$sessionPassword'");    
if(!$result) {
	die("you suck: " . mysql_error());
}
 if($row = mysqli_fetch_array($result)){
     echo yay;
     //session variables to be used on each page!!!
     $_SESSION["Name"]=$row['Name'];
     $_SESSION["Username"]=$row['Username'];
     $_SESSION["ID"]=$row['ID'];
     $_SESSION["Email"]=$row['Email'];
     
     header("Location: /HackPrinceton/addFriend.php");
     $_SESSION["login"]= "true";
     header("Location: views/index.html");
        }
else{
    
}
?>