<?php

//create database:

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

$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "INSERT INTO Users (firstname, lastname, email, password) 
			VALUES ('$firstName', '$lastName', '$username', 'password')";

echo "success";



    ?>

















