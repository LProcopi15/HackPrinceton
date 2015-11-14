<?php
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

//$drop = $db->query("drop table Users");
//mysql_query($drop);

$makeUsers = $db->query("create table Users(ID int primary key not null auto_increment, Name char(50) not null, Username char (50) not null, Email char(100) not null, Password char(15) not null, imgdata char(200) not null)");
$makeRelationship = $db->query("create table Relationship(Friend1 int not null, Friend2 int not null, Status int not null)");


(mysql_query($makeUsers));
(mysql_query($makeRelationship));

echo 'complete';

?>