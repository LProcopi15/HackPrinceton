<?php


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

/*
$drop = $db->query("drop table Users");
mysql_query($drop);
*/

$makeUsers = $db->query("create table Users(ID int primary key not null auto_increment, Name char(50) not null, Username char (50) not null, Email char(100) not null, Password char(15) not null, imgdata char(200) not null)");
$makeRelationship = $db->query("create table Relationship(Friend1 int not null, Friend2 int not null, Status int not null)");
$makeDiscounts = $db->query("create table Discount(Restaurant char(30) not null, Discount char(50) not null, Location char(150) not null)");
$makeEvent = $db->query("create table Event(Driver char(50) not null, Time char(15) not null, Destination char(75) not null, Attendees char(100) not null)");


(mysql_query($makeUsers));
(mysql_query($makeRelationship));
(mysql_query($makeDiscounts));
(mysql_query($makeEvent));


$discountZ= file("discounts.flat");
foreach($discountZ as $discountstring){
$discountstring = rtrim($discountstring);
    $discounts = explode(";",$discountstring);
    $query = "insert into Discount values ('$discounts[0]','$discounts[1]','$discounts[2]')"; 
    $db->query($query) or die ("Invalid insert " . $db->error); 
}

header("Location: /HackPrinceton/landing-page/landing.html");

?>