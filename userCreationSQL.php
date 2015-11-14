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
if ($_POST['password1']==$_POST['password2']) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password1'];


	$query = "INSERT INTO Users(`Name`, `Username`, `Email`, `Password`) VALUES('$name', '$username', '$email', '$password')";

	$db->query($query) or die ("Invalid insert " .$db->error);
}
else {
	echo "Passwords do not match. Please go back to login";
}

?>

















