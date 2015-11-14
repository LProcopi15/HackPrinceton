<?php

header("Location: ../views/index.html");
die();

session_start();

$sessionUsername = $_POST['username'];
$sessionPassword = $_POST['password'];




$db = mysqli_connect('localhost', 'root', 'password', 'test');
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
        }

else{

    
}
?>