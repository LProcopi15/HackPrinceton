<?php
session_start();

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

$checking = $_POST["name"];

$designatedName = $_SESSION['Username'];

$selectDD = mysqli_query($db,"SELECT * FROM Users WHERE Username = '$designatedName'"); 
$userInfo = mysqli_fetch_array($selectDD); 
$userID = $userInfo['ID'];




$f1 = mysqli_query($db,"SELECT * FROM Relationship WHERE Friend1 = $userID"); 
$f2 = mysqli_query($db,"SELECT * FROM Relationship WHERE Friend2 = $userID ");

//fetch every person that is friends with the designated driver, check as if they were friend 1 first and then friend 2
while($row = mysqli_fetch_array($f1)){
//if this person exists and they are friends (status = 2) then append it to the page
    if($row['Friend2'] == $checking && $row['Status'] == 2){
        echo $checking;
    }
}
while($rowS = mysqli_fetch_array($f2)){
//if this person exists and they are friends (status = 2) then append it to the page
    if($rowS['Friend1'] == $checking && $rowS['Status'] == 2){
        echo $checking;
    }
}

?>