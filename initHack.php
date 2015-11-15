<?php

    $db = mysqli_connect('localhost', 'root', 'password', 'test');
if($db->connect_error){
    print "Error - Could not connnect to MySQL";
    exit;
}

if($db->connect_error){
    print "Error - Could not connnect to MySQL";
    exit;
}

/*
$drop = $db->query("drop table Users");
mysql_query($drop);
*/

$makeUsers = $db->query("create table Users(ID int primary key not null auto_increment, Name char(50) not null, Username char (50) not null, Email char(100) not null, Password char(15) not null, imgdata longblob not null)");
$makeRelationship = $db->query("create table Relationship(Friend1 int not null, Friend2 int not null, Status int not null)");
$makeDiscounts = $db->query("create table Discount(Restaurant char(30) not null, Discount char(50) not null, Location char(150) not null)");
$makeEvent = $db->query("create table Event(Driver char(50) not null, Time date not null, Attendees char(100) not null, Destination char(75) not null)");

(mysql_query($makeUsers));
(mysql_query($makeRelationship));


$discountZ= file("discounts.flat");
foreach($discountZ as $discountstring){
$discountstring = rtrim($discountstring);
    $discounts = explode(";",$discountstring);
    $query = "insert into Discount values ('$discounts[0]','$discounts[1]','$discounts[2]')"; 
    $db->query($query) or die ("Invalid insert " . $db->error); 
}



header("Location: /HackPrinceton/landingPage.html");

?>
    $db = mysqli_connect('localhost', 'root', 'password', 'test');
if($db->connect_error){
    print "Error - Could not connnect to MySQL";
    exit;
}

if($db->connect_error){
    print "Error - Could not connnect to MySQL";
    exit;
}

/*
$drop = $db->query("drop table Users");
mysql_query($drop);
*/

$makeUsers = $db->query("create table Users(ID int primary key not null auto_increment, Name char(50) not null, Username char (50) not null, Email char(100) not null, Password char(15) not null, imgdata longblob not null)");
$makeRelationship = $db->query("create table Relationship(Friend1 int not null, Friend2 int not null, Status int not null)");
$makeDiscounts = $db->query("create table Discount(Restaurant char(30) not null, Discount char(50) not null, Location char(150) not null)");
$makeEvent = $db->query("create table Event(Driver char(50) not null, Time date not null, Attendees char(100) not null, Destination char(75) not null)");

(mysql_query($makeUsers));
(mysql_query($makeRelationship));


$discountZ= file("discounts.flat");
foreach($discountZ as $discountstring){
$discountstring = rtrim($discountstring);
    $discounts = explode(";",$discountstring);
    $query = "insert into Discount values ('$discounts[0]','$discounts[1]','$discounts[2]')"; 
    $db->query($query) or die ("Invalid insert " . $db->error); 
}



header("Location: /HackPrinceton/landingPage.html");

?>