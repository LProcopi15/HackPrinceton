<?php

$db = new mysqli("localhost", "root", "password", "test");
$testdatabase = mysql_select_db("test");

if($db->connect_error){
    print "Error - Could not connnect to MySQL";
    exit;
}


$makeUsers = $db->query("create table Users(ID int not null auto_increment, Name char(50) not null, Username char (50) not null, Email char(100) not null, Password char(15) not null)");
$makeRelationship = $db->query("create table Relationship(Friend1 int not null, Friend2 int not null, Status int not null)");


(mysql_query($makeUsers));
(mysql_query($makeRelationship));



?>